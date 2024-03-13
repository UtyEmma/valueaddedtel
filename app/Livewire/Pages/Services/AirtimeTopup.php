<?php

namespace App\Livewire\Pages\Services;

use App\Enums\Services;
use App\Models\Services\Service;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class AirtimeTopup extends Component {

    public User $user;
    public Service $service;
    public $products = [];

    function mount(){
        $this->user = authenticated();
        $this->service = $this->user->service(Services::AIRTIME);
        $this->products = $this->service->products()->where('country_code', $this->user->country_code)->get();

    }

    function initiate(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
