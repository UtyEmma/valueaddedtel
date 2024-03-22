<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\Livewire\WithToast;
use Illuminate\Support\Facades\Hash;
use App\Services\Account\ProfileService;
use Livewire\Attributes\Layout;

#[Layout('layouts.auth')]
class Pin extends Component {
    use WithToast;

    public $pin;
    public $pin_confirmation;
    public User $user;

    public $step = 1;

    function mount(){
        $this->user = authenticated();
        if(!empty($this->user->pin)) return $this->redirectIntended(RouteServiceProvider::HOME);
    }

    function next(){
        $this->validate([
            'pin' => ['required', 'digits:4']
        ]);
        $this->step = 2;
    }

    function back(){
        $this->step = 1;
    }

    function update(){
        $this->validate([
            'pin' => ['required', 'confirmed', 'digits:4']
        ]);

        $this->user->pin = Hash::make($this->pin);
        $this->user->save();

        if(!$this->user->accounts->count()){
            [$status, $message] = (new ProfileService)->setBankAccounts($this->user);
            if(!$status && $message) $this->toast($message, 'Pin Updated')->error();
        }

        return $this->redirectIntended(RouteServiceProvider::HOME);
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }

    function render(){
        return view('livewire.pages.auth.pin');
    }

}
