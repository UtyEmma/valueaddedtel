<?php

namespace App\Livewire\Pages\Services;

use App\Enums\PaymentStatus;
use App\Enums\Services;
use App\Enums\Status;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\Transactions\Transaction;
use App\Models\User;
use App\Modules\AirtimeModule;
use App\Services\PaymentMethodService;
use App\Traits\Livewire\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard', [
    'title' => 'Airtime Topup',
    "breadcrumbs" => [
        // ['title' => 'Overview', 'href' => route('dashboard')],
        ['title' => 'Airtime Topup']
    ]
])]
class AirtimeTopup extends Component {
    use WithToast;

    public User $user;
    public Service $service;

    public Transaction $transaction;

    public $products = [];
    public $methods = [];

    public $countryService;

    public $step = 1;

    public $payment_method;
    public $amount;
    public $phone;
    public $network;
    public ServiceProduct $product;

    function mount(){
        $this->user = authenticated();
        $this->service = $this->user->service(Services::AIRTIME);
        $this->countryService = $this->service->serviceCountries()->where('country_code', $this->user->country_code)->first();

        $this->products = $this->service->products()->where('country_code', $this->user->country_code)->get();
        $this->methods = (new PaymentMethodService)->service($this->service);
    }

    function cancel(){
        $this->step = 1;
        $this->toast('If you are encountering any challenges, please contact our support center', 'Purchase Cancelled')->warning();
        return $this->js("$('#confirm-modal').modal('hide')");
    }

    function completed(){

    }

    function complete(){
        $validated = $this->validate([

        ]);

        $module = new AirtimeModule;
        [$status, $message, $data] = $module->initiate($this->transaction);
        if(!$status) return $this->toast($message);

        if($message == Status::COMPLETED) {
            [$status, $message, $vtuHistory] = $data;
            if(!$status) return $this->toast($message)->error();

            if($vtuHistory->status == PaymentStatus::SUCCESS) {
                return $this->toast("Your airtime purchase was successful")->success();
            }

        }

        if($message == Status::PENDING) {
            $payment_method = $this->transaction->paymentMethod;
            return $this->dispatch('pay:'.$payment_method, $data);
        }
    }

    function pay(){
        $validated = $this->validate([
            'payment_method' => ['required', 'in:'.implode(',', $this->methods)],
            'amount' => 'required|min:1',
            'phone' => 'required',
            'network' => 'required|exists:service_products,shortcode',
        ]);

        $module = new AirtimeModule;
        [$status, $message, $transaction] = $module->create($validated);

        if(!$status) return $this->toast($message)->error();

        $this->transaction = $transaction;
        return $this->step = 2;
    }

    function confirm(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    function initiate(){

        $this->validate([
            'amount' => 'required|min:1',
            'phone' => 'required',
            'network' => 'required|exists:service_products,shortcode'
        ]);


        return $this->dispatch('pay:paystack');

        $this->product = ServiceProduct::where('shortcode', $this->network)->first();
        if(!$this->product?->is_available) return $this->toast('The selected network is unavailable at the moment! Please try again later.', 'Network unavailable')->error();
        return $this->confirm();
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
