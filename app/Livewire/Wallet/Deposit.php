<?php

namespace App\Livewire\Wallet;

use App\Enums\PaymentMethods;
use App\Enums\Services;
use App\Models\Services\Service;
use App\Models\Transactions\PaymentMethod;
use App\Models\User;
use App\Rules\ValidPaymentMethod;
use App\Services\Account\DepositService;
use App\Traits\Livewire\WithToast;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Deposit extends Component {
    use WithToast;

    public $amount;
    public $step = 1;
    public $payment_method;
    public PaymentMethod $paymentMethod;
    public User $user;
    public Service $service;

    public $paymentMethods = [];

    function mount(DepositService $depositService){
        $this->user = authenticated();
        $this->service = $depositService->service;
        $this->paymentMethods = $depositService->paymentMethods();
    }

    function rules(){
        return [
            'payment_method' => [
                'required',
                new Enum(PaymentMethods::class),
                new ValidPaymentMethod(
                    service: $this->service->shortcode,
                    country: $this->user->country->iso_code,
                )
            ]
        ];
    }

    function back(){
        $this->step = 1;
    }

    function select($shortcode){
        $this->validateOnly('payment_method');
        if(!$this->paymentMethod = PaymentMethod::isActive()->whereShortcode($this->payment_method)->first()){
            $this->toast('The selected payment method is not valid. Please confirm your selection and try again!', 'Invalid Payment Method')->error();
            return;
        }
        $this->step = 2;
    }

    function cancel(){
        $this->reset(['amount', 'payment_method']);
        $this->back();
        $this->js("$('#deposit-modal').modal('hide')");
    }

    function pay(){

    }

    public function render()
    {
        return view('livewire.wallet.deposit');
    }
}
