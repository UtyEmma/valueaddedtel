<?php

namespace App\Livewire\Pages;

use App\Traits\Livewire\CanRefresh;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Wallet extends Component {

    public $user;

    function mount(){
        $this->user = authenticated();
    }

    #[On('payment:complete')]
    function completed(){

    }

    public function render() {
        $transactions = $this->user->transactions()->latest()->paginate();
        return view('livewire.pages.wallet', compact('transactions'));
    }
}
