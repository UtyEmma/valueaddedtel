<div>
    <x-modal id="deposit-modal" class="w-450px" data-bs-backdrop="static" data-bs-keyboard="false" >

        @if ($step == 1)
            <h3 class="mb-8">Fund your Wallet</h3>

            <form wire:submit="select">
                <div class="mb-5 fv-row">
                    <x-input.label>Amount</x-input.label>
                    <x-input.price placeholder="0.00" wire:model="amount" name="amount" />
                    <x-input.error key="amount" />
                </div>

                <div class="mb-4">
                    <h6>Select a Payment Method</h6>
                </div>

                <div class="gap-4 d-flex flex-column">
                    <div>
                        <x-input.payment.methods :amount="$amount" :methods="$methods" wire:model="payment_method" />
                        <x-input.error key="payment_method" />
                    </div>
                </div>

                <div class="my-5 separator"></div>

                <div class="gap-5 d-flex justify-content-end">
                    {{-- wire:click="cancel" wire:loading wire:target="cancel" --}}
                    <x-button type="button" data-bs-dismiss="modal" wire:loading.attr="disabled" wire:target="select" class="btn-light" color="primary">Cancel</x-button>
                    <x-button wire:loading wire:target="select" class="btn-primary">Proceed</x-button>
                </div>
            </form>
        @endif

        @if ($step == 2)
            <form wire:submit="pay">
                <h3 class="mb-8 text-center">Enter your payment pin</h3>

                <div class="px-20 mb-5">
                    <x-input.pin type="password" wire:model="pin" class="justify-content-start" />

                    <x-input.error key="amount" />
                    <x-input.error key="payment_method" />
                    <x-input.error key="pin" />
                </div>

                <div class="text-center">
                    <x-swal title="You are exiting your current payment. Are you sure you wish to proceed?"  href="#">Forgot Payment Pin</x-swal>
                </div>

                <div class="my-5 separator"></div>

                <div class="gap-5 d-flex justify-content-end">
                    <x-button type="button" wire:click="cancel" data-bs-dismiss="modal" wire:loading wire:target="cancel" class="btn-light" color="primary">Cancel</x-button>
                    <x-button type="submit" class="px-10 btn-primary" x-on:click="block()">Pay</x-button>
                </div>
            </form>
        @endif
    </x-modal>

    @include('gateways.index')
    {{-- <livewire:payment.checkout /> --}}
</div>
