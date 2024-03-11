<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Services\AuthService;

new #[Layout('layouts.auth')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void {
        $data = $this->validate();
        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME);
    }
}; ?>


<div>
    <x-slot:side>
        <div class="p-10 pb-0 d-flex flex-column flex-center pb-lg-10 w-100">
            <!--begin::Image-->
            <img class="mx-auto mb-10 theme-light-show mw-100 w-150px w-lg-300px mb-lg-20" src="assets/media/auth/agency.png" alt="" />
            <img class="mx-auto mb-10 theme-dark-show mw-100 w-150px w-lg-300px mb-lg-20" src="assets/media/auth/agency-dark.png" alt="" />
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="text-center text-gray-800 fs-2qx fw-bold mb-7">Fast, Efficient and Productive</h1>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="text-center text-gray-600 fs-base fw-semibold">In this kind of post,
            <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed
            <br />and provides some background information about
            <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
            <br />work following this is a transcript of the interview.</div>
            <!--end::Text-->
        </div>
    </x-slot:side>

    <div class="d-flex flex-center flex-column flex-column-fluid">
        <form class="form w-100" novalidate="novalidate" wire:submit="login">
            <div class="mb-11">
                <h1 class="mb-1 text-gray-900 fw-bolder">Welcome Back</h1>
                <div class="text-gray-500 fw-semibold fs-6">Please log into your account</div>
            </div>

            <div class="mb-8 fv-row">
                <x-input.label>Username</x-input.label>
                <x-input type="text" placeholder="Username" wire:model="form.username" autocomplete="off" class="bg-transparent form-control" />
                <x-input.error key="form.username" />
            </div>

            <div class="mb-3 fv-row">
                <x-input.label>Password</x-input.label>
                <x-input type="password" placeholder="Password" wire:model="form.password" autocomplete="off" class="bg-transparent form-control" />
                <x-input.error key="form.password" />
            </div>

            <x-input.checkbox wire:model="form.remember">Remember Me</x-input.checkbox>

            <div class="flex-wrap gap-3 mb-8 d-flex flex-stack fs-base fw-semibold">
                <div></div>
                <a href="{{route('password.request')}}" class="link-primary">Forgot Password ?</a>
            </div>

            <div class="mb-10 d-grid">
                <x-button class="btn-primary" wire:loading wire:target="login">Sign In</x-button>
            </div>

            <div class="text-center text-gray-500 fw-semibold fs-6">Not a Member yet?
            <a href="{{route('register')}}" class="link-primary">Sign up</a></div>
        </form>
    </div>
</div>
