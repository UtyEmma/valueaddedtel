<?php

namespace App\Livewire\Wallet;

use App\Enums\PaymentMethods;
use App\Enums\Services;
use App\Models\Services\Service;
use App\Models\Transactions\PaymentMethod;
use App\Models\Transactions\Transaction;
use App\Models\User;
use App\Rules\ValidPaymentMethod;
use App\Rules\ValidPin;
use App\Services\Account\DepositService;
use App\Services\PaymentMethodService;
use App\Traits\Livewire\WithToast;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\On;
use Livewire\Component;

class Deposit extends Component {
    use WithToast;

    public $amount;
    public $step = 1;
    public $methods = [];
    public $payment_method;
    public $pin = null;

    public PaymentMethod $paymentMethod;
    public Transaction $transaction;

    public User $user;
    public Service $service;

    public $paymentMethods = [];

    function mount(DepositService $depositService){
        $this->user = authenticated();
        $this->service = $depositService->service;
        $this->paymentMethods = $depositService->paymentMethods();
        $this->methods = (new PaymentMethodService)->service($this->service);
    }

    function rules(){
        $rules = [
            'payment_method' => [
                'required', new Enum(PaymentMethods::class),
                new ValidPaymentMethod(
                    service: $this->service->shortcode,
                    country: $this->user->country->iso_code,
                )
            ],
            'amount' => ['required', 'numeric', 'min:1'],
        ];

        if($this->step == 2) $rules = array_merge(['pin' => ['required', 'numeric', new ValidPin($this->user)]], $rules);
        return $rules;
    }

    function back(){
        $this->step = 1;
    }

    function select(){
        $this->validate();
        if(!$this->paymentMethod = PaymentMethod::isActive()->whereShortcode($this->payment_method)->first()){
            $this->toast('The selected payment method is not valid. Please confirm your selection and try again!', 'Invalid Payment Method')->error();
            return;
        }
        $this->step = 2;
    }

    function cancel() {
        $this->reset(['amount', 'payment_method', 'pin', 'transaction']);
        $this->back();
        $this->js("$('#deposit-modal').modal('hide'); Notiflix.Loading.remove();");
    }

    function pay(){
        $validated = $this->validate();
        $depositService = new DepositService;

        [$status, $message, [$transaction, $data]] = $depositService->initiate($validated);
        $this->transaction = $transaction;

        if(!$status) {
            $this->toast($message)->error();
            return $this->cancel();
        }

        $this->dispatch('payment:'.$this->payment_method, $data);
    }

    #[On('payment:cancelled')]
    function cancelled(){
        (new DepositService)->cancel($this->transaction);
        $this->toast('If you are facing any challenges, please contact our support center for assistance', 'Your payment attempt was cancelled')->warning();
        $this->cancel();
    }

    #[On('payment:completed')]
    function completed(){
        [$status, $message] = (new DepositService)->verify($this->transaction);
        if(!$status) return $this->toast($message, 'Something went wrong')->error();
        $this->dispatch('payment:complete');
        $this->toast('Your funds has be credited to your wallet', $message)->success();
        $this->cancel();
    }

    public function render() {
        return view('livewire.wallet.deposit');
    }
}
