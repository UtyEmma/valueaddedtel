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
        $this->products = $this->countryService->products;
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
        $this->reset(['amount', 'phone', 'network', 'product']);
        // $this->toast('If you are encountering any challenges, please contact our support center', 'Purchase Cancelled')->warning();
        return $this->js("$('#confirm-modal').modal('hide')");
    }

    function complete(AirtimeModule $airtimeModule){
        $validated = $this->validate();
        $data = collect($validated)->only(['amount', 'phone', 'network'])->toArray();
        [$status, $message, $purchase] = $airtimeModule->purchase($data, $this->user);
        if(!$status) return $this->toast($message, 'Purchase Failed')->error();
        return $this->toast($message, PaymentStatus::title($purchase->status), PaymentStatus::alert($purchase->status));
    }

    function pay(){
        $this->validate();
        return $this->step = 2;
    }

    function confirm(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    function initiate(){
        $this->validate();
        // $product ServiceProduct::where('shortcode', $this->network)->first();
        // dd($this->product);

        // if(!$this->product?->is_available) {
        //     return $this->toast('The selected network is unavailable at the moment! Please try again later.', 'Network unavailable')->error();
        // }

        // $this->product = $product;

        return $this->confirm();
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
