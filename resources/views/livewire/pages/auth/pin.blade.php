<div>
    <div class="d-flex flex-center flex-column flex-column-fluid">
        <div class="mx-auto w-md-75">
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
                        <x-input.pin wire:model="pin" type="password" />
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
                        <x-input.pin wire:model="pin_confirmation" type="password" />
                        <x-input.error key="pin" />
                    </div>

                    <div class="mb-10 d-grid">
                        <x-button class="mb-3 btn-primary w-100" wire:loading wire:target="update">Update Pin</x-button>
                        <x-button class="btn-light w-100" type="button" color="muted" wire:click="back" wire:loading wire:target="back">Back</x-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
