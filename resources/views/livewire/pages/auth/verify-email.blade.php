<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Rules\ValidCode;
use App\Models\User;
use App\Traits\Livewire\WithToast;
use App\Models\Account\EmailVerification;

new #[Layout('layouts.auth')] class extends Component {
    use WithToast;


    public $code;
    public User $user;

    function mount(){
        $this->user = authenticated();

        if($this->user->hasVerifiedEmail()) {
            return $this->redirectIntended(RouteServiceProvider::HOME);
        }
    }

    public function resend(): void {
        if ($this->user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);
            return;
        }

        $this->user->sendVerificationEmail();
        $this->toast('Another email verification code was sent to '.$this->user->email, 'Verification code sent')->success();
    }

    function verify(){
        $this->validate([
            'code' => ['required', 'numeric', 'digits:6', new ValidCode(class: EmailVerification::class)]
        ]);

        [$status, $message] = $this->user->verifyEmail($this->code);
        if(!$status) {
             $this->toast($message, 'Email Verification Failed')->error();
             return;
        }

        $this->toast($message, 'Success')->success();

        return $this->redirectIntended(RouteServiceProvider::HOME);
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>

<div>
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <form class="form w-100" novalidate="novalidate" wire:submit="verify">
            <div class="text-center mb-11">
                <h1 class="mb-1 text-gray-900 fw-bolder">Please Verify your Email Address</h1>
                <div class="text-gray-500 fw-semibold fs-6">We have sent a verification code to <span class="text-primary">{{$authenticated->email}}</span>. Please provide the code below to verify your Email Address.</div>
            </div>

            <div class="mb-8 fv-row">
                <x-input.pin wire:model="code" digits="6" />
                <x-input.error key="code" />
            </div>

            <div class="mb-10 d-grid">
                <x-button class="btn-primary" wire:loading wire:target="verify">Verify Email Address</x-button>
            </div>

            <div class="text-center fs-6 fw-bold"
                x-data
                x-init=""
                >
                <p class="mb-0">Code Expires in</p>
                <p class="text-muted">10:40</p>
            </div>

            <div class="text-center text-gray-500 fw-semibold fs-6">Did not recieve the code?
            <span role="button" type="button" wire:click="resend" class="link-primary">Resend</span> <x-spinner color="primary" wire:loading wire:target="resend"  /></div>

            <div class="my-5 separator"></div>

            <div class="text-center text-gray-500 fw-semibold fs-6">Wrong Email Address?
            <span role="button" type="button" wire:click="logout" class="link-primary">Logout</span> <x-spinner color="primary" wire:loading wire:target="logout"  /></div>
        </form>
    </div>
</div>
