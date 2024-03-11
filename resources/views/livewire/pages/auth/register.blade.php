<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Authentication\AuthService;
use App\Models\Country;

new #[Layout('layouts.auth')] class extends Component
{

    public $step = 1;

    public $firstname, $lastname, $email, $password, $password_confirmation, $username;
    public $referrer, $phone, $country;

    public $tel;

    function mount(){
        $defaultCountry = Country::has('supported')->where('is_default', true)->first();
        $this->country = $defaultCountry?->iso_code;
        $this->tel = $defaultCountry->intl_phone;
    }

    function rules(){
        $rules  = collect((new RegisterRequest)->rules());
        return $rules->when($this->step == 1, fn($rules) => $rules->except(['password', 'username', 'referrer']))->toArray();
    }

    function start(){
        $this->validate();
        $this->step = 2;
    }

    public function register(): void
    {
        $validated = $this->validate();

        $user = (new AuthService)->register($validated);

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME);
    }
}; ?>

<div class="d-flex flex-center flex-column flex-column-fluid">
    <x-slot:side>
        <div class="p-10 pb-0 d-flex flex-column flex-center pb-lg-10 w-100">
            <img class="mx-auto mb-10 theme-light-show mw-100 w-150px w-lg-300px mb-lg-20" src="assets/media/auth/agency.png" alt="" />
            <img class="mx-auto mb-10 theme-dark-show mw-100 w-150px w-lg-300px mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" />

            <h1 class="text-center text-gray-800 fs-2qx fw-bold mb-7">Fast, Efficient and Productive</h1>
            <div class="text-center text-gray-600 fs-base fw-semibold">In this kind of post,
            <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed
            <br />and provides some background information about
            <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
            <br />work following this is a transcript of the interview.</div>
        </div>
    </x-slot:side>

    <form class="form w-100" novalidate="novalidate" wire:submit="{{$step == 1 ? 'start' : 'register'}}">
       <div class="mb-11">
           <h1 class="mb-1 text-gray-900 fw-bolder">Are you ready to transform your financial future?</h1>
           <div class="text-gray-500 fw-semibold fs-6">Create your account now!</div>
       </div>

       @if($step == 1)
            <div class="mb-8 row g-5">
                <div class="fv-row col-md-6">
                    <x-input.label>Select your Country</x-input.label>
                    <x-input.countries value="{{$country}}" name="country" />
                    <x-input.error key="country" />
                </div>

                <div class="col-md-6"></div>

                <div class="fv-row col-6">
                    <x-input.label>First Name</x-input.label>
                    <x-input type="text" placeholder="First Name" wire:model="firstname" class="bg-transparent form-control" />
                    <x-input.error key="firstname" />
                </div>

                <div class="fv-row col-6">
                    <x-input.label>Last Name</x-input.label>
                    <x-input type="text" placeholder="Last Name" wire:model="lastname" class="bg-transparent form-control" />
                    <x-input.error key="lastname" />
                </div>

                <div class="fv-row">
                    <x-input.label>Email Address</x-input.label>
                    <x-input type="text" placeholder="Email Address" wire:model="email" autocomplete="off" class="bg-transparent form-control" />
                    <x-input.error key="email" />
                </div>

                <div class="fv-row">
                    <x-input.label>Phone Number</x-input.label>
                    <x-input.group type="text" placeholder="Phone Number" wire:model="phone"  >
                        <x-slot:left>+{{$this->tel}}</x-slot:left>
                    </x-input.group>
                    <x-input.error key="phone" />
                </div>
            </div>

            <div class="mb-10 d-grid">
                <x-button class="btn-primary" wire:loading wire:target="start">Get Started</x-button>
            </div>
       @endif

       @if ($step == 2)
            <div class="mb-8 row g-5">
                <div class="fv-row">
                    <x-input.label>Username</x-input.label>
                    <x-input type="text" placeholder="Username" wire:model="username" autocomplete="off" class="bg-transparent form-control" />
                    <x-input.error key="username" />
                </div>

                <div class="fv-row">
                    <x-input.label>Referred By</x-input.label>
                    <x-input type="text" placeholder="Referrer Username" wire:model="referrer" autocomplete="off" class="bg-transparent form-control" />
                    <x-input.error key="referrer" />
                </div>

                <div class=" fv-row">
                    <x-input.label>Password</x-input.label>
                    <x-input type="password" placeholder="Password" wire:model="password" autocomplete="off" class="bg-transparent form-control" />
                    <x-input.error key="password" />
                </div>

                <div class=" fv-row">
                    <x-input.label>Confirm Password</x-input.label>
                    <x-input type="password" placeholder="Password" wire:model="password_confirmation" autocomplete="off" class="bg-transparent form-control" />
                    <x-input.error key="password_confirmation" />
                </div>
            </div>

            <div class="mb-10 d-grid">
                <x-button class="btn-primary" wire:loading wire:target="register">Create my Account</x-button>
            </div>
       @endif


       <div class="text-center text-gray-500 fw-semibold fs-6">Already have an account?
       <a href="{{route('login')}}" class="link-primary">Log in</a></div>
   </form>
</div>

