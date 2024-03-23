<?php

namespace App\Livewire\Payment;

use Livewire\Attributes\On;
use Livewire\Component;

class Checkout extends Component
{

    #[On('payment:cancelled')]
    function cancelled($data){
        dd($data);
    }

    #[On('payment:completed')]
    function completed($data){
        dd($data);
    }

    public function render()
    {
        return view('livewire.payment.checkout');
    }
}
