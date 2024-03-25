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
use App\Rules\ValidPin;
use App\Rules\ValidProduct;
use App\Services\PaymentMethodService;
use App\Traits\Livewire\WithToast;
use Illuminate\Validation\Rule;
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
    public $products = [];
    public $methods = [];

    public $countryService;

    public $step = 1;
    public $amount, $phone,  $network;
    public $pin;

    public ServiceProduct | null $product = null;

    function mount(){
        $this->user = authenticated();
        $this->service = $this->user->service(Services::AIRTIME);
        $this->countryService = $this->service->serviceCountries()->where('country_code', $this->user->country_code)->first();
        $this->products = $this->countryService->products;
    }

    function rules(){
        $rules = [
            'amount' => 'required|numeric|min:50,max:50000',
            'phone' => 'required|phone:'.$this->user->country_code,
            'network' => ['required', new ValidProduct($this->service, $this->user)],
        ];

        if($this->step == 2) $rules = array_merge($rules, ['pin' => ['required', 'size:4', new ValidPin($this->user)]]);
        return $rules;
    }

    function cancel(){
        // $this->reset('amount', 'phone', 'network');
        // $this->product = null;
        $this->step = 1;
        return $this->js("$('#confirm-modal').modal('hide')");
    }

    function complete(AirtimeModule $airtimeModule){
        $validated = $this->validate();
        $data = collect($validated)->only(['amount', 'phone', 'network'])->toArray();
        [$status, $message, $purchase] = $airtimeModule->purchase($data, $this->user);

        if(!$status) {
            $this->toast($message, 'Purchase Failed')->error();
        }else{
            $this->toast($message, PaymentStatus::title($purchase->status))->trigger(PaymentStatus::alert($purchase->status));
            $this->step = 3;
            return;
        }

        $this->cancel();
    }

    function pay(){
        $this->validate();
        return $this->step = 2;
    }

    function confirm(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    function initiate(){
        $validated = $this->validate();

        $this->product = $this->service
                            ->products()
                            ->whereShortcode($this->network)
                            ->whereCountryCode($this->user->country_code)->first();

        return $this->confirm();
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
