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
    public $amount;
    public $phone;
    public $network;
    public $pin;

    public ServiceProduct $product;

    function mount(){
        $this->user = authenticated();
        $this->service = $this->user->service(Services::AIRTIME);
        $this->countryService = $this->service->serviceCountries()->where('country_code', $this->user->country_code)->first();
        $this->products = $this->service->products()->where('country_code', $this->user->country_code)->get();
    }

    function rules(){
        $rules = [
            'amount' => 'required|min:1',
            'phone' => 'required',
            'network' => 'required|exists:service_products,shortcode',
        ];

        if($this->step == 2) {
            $rules = array_merge($rules, ['pin' => []]);
        }

        return $rules;
    }

    function cancel(){
        $this->step = 1;
        $this->toast('If you are encountering any challenges, please contact our support center', 'Purchase Cancelled')->warning();
        return $this->js("$('#confirm-modal').modal('hide')");
    }

    function complete(){
        $validated = $this->validate();
    }

    function pay(){
        $validated = $this->validate();
        return $this->step = 2;
    }

    function confirm(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    function initiate(){
        $this->validate();
        $this->product = ServiceProduct::where('shortcode', $this->network)->first();
        
        if(!$this->product?->is_available) {
            return $this->toast('The selected network is unavailable at the moment! Please try again later.', 'Network unavailable')->error();
        }

        return $this->confirm();
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
