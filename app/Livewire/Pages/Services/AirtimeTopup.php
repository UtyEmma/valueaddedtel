<?php

namespace App\Livewire\Pages\Services;

use App\Enums\Services;
use App\Models\Services\Service;
use App\Models\Services\ServiceProduct;
use App\Models\User;
use App\Modules\AirtimeModule;
use App\Services\PaymentMethodService;
use App\Services\TransactionService;
use App\Traits\Livewire\WithPayment;
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
    use WithToast, WithPayment;

    public User $user;
    public Service $service;
    public $products = [];
    public $methods = [];

    public $step = 1;

    public $payment_method;
    public $amount;
    public $phone;
    public $network;
    public ServiceProduct $product;

    function rules(){
        return [
            'amount' => 'required|min:1',
            'phone' => 'required',
            'network' => 'required|exists:service_products,shortcode'
        ];
    }

    function mount(){
        $this->user = authenticated();
        $this->service = $this->user->service(Services::AIRTIME);
        $this->products = $this->service->products()->where('country_code', $this->user->country_code)->get();
        $this->methods = (new PaymentMethodService())->service($this->service);
    }

    function initiate(){
        $this->validate();
        $this->product = ServiceProduct::where('shortcode', $this->network)->first();
        if(!$this->product?->is_available) return $this->toast('The selected network is unavailable at the moment! Please try again later.', 'Network unavailable')->error();

        return $this->confirm();
    }

    function handle(){
        // (new AirtimeModule)
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
