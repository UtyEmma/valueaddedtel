<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Rules\ValidCode;
use App\Models\Account\User;
use App\Traits\Livewire\WithToast;
use App\Models\Account\EmailVerification;
use Illuminate\Support\Facades\Hash;

new #[Layout('layouts.auth')] class extends Component {
    use WithToast;

    public $pin;
    public $pin_confirmation;
    public User $user;

    public $step = 1;

    function mount(){
        $this->user = authenticated();
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

        return $this->redirectIntended(RouteServiceProvider::HOME);
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>

<div>
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="w-md-75 mx-auto">
            <div class="mb-10 text-center">
                <img src="{{asset('assets/media/logos/default.svg')}}" class="h-25px" alt="">
            </div>
            <div class="text-center mb-11">
                <h1 class="mb-1 text-gray-900 fw-bolder">Secure your Account</h1>
                <div class="text-gray-500 fw-semibold fs-5">Setup a 4 digit Transaction Pin to secure your payments and transactions.</div>
            </div>

            @if ($step == 1)
                <form wire:submit="next">
                    <div class="mb-8">
                        <x-input.label>Enter your Pin</x-input.label>
                        <x-input.pin wire:model="pin" />
                        <x-input.error key="pin" />
                    </div>

                    <div class="mb-10 d-grid">
                        <x-button class="btn-primary" wire:loading wire:target="next">Confirm Pin</x-button>
                    </div>
                </form>
            @endif

            @if ($step == 2)
                <form wire:submit="update">
                    <div class="mb-8">
                        <x-input.label>Confirm your Pin</x-input.label>
                        <x-input.pin wire:model="pin_confirmation" />
                        <x-input.error key="pin" />
                    </div>

                    <div class="mb-10 d-grid">
                        <x-button class="btn-primary w-100 mb-3" wire:loading wire:target="update">Update Pin</x-button>
                        <x-button class="btn-light w-100" type="button" wire:click="back" wire:loading wire:target="back">Back</x-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
