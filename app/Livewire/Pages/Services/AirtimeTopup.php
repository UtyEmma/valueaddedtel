<?php

namespace App\Livewire\Pages\Services;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class AirtimeTopup extends Component {

    function initiate(){
        return $this->js("$('#confirm-modal').modal('show')");
    }

    public function render()
    {
        return view('livewire.pages.services.airtime-topup');
    }
}
