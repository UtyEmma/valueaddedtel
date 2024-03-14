<div>
    <x-modal id="deposit-modal" class="w-450px" data-bs-backdrop="static" data-bs-keyboard="false" >
        <div class="mb-8">
            <h4>Fund your Wallet</h4>
        </div>

        @if ($step == 1)
            <div class="mb-4">
                <h6>Select a Payment Method</h6>
            </div>
            <div class="d-flex flex-column gap-4">
                <x-input.error key="payment_method" />
                @forelse ($paymentMethods as $paymentMethod)
                    <label role="button" wire:click="select('{{$paymentMethod->shortcode->value}}')" class="bg-light rounded p-5 cursor-pointer d-flex flex-stack">
                        <span class="gap-3 d-flex align-items-center me-2">
                            <span class="symbol symbol-40px">
                                <span class="symbol-label bg-light-primary">
                                    <img class="rounded img-fluid" src="{{$paymentMethod->image_file}}" />
                                </span>
                            </span>
                            <span class="d-flex flex-column">
                                <span class="mb-0 fw-bold fs-6 text-primary">{{$paymentMethod->name}}</span>
                            </span>
                        </span>
                        <input hidden wire:model="payment_method" value="{{$paymentMethod->shortcode->value}}" type="radio" />

                        <span>
                            <i wire:loading.remove wire:target="select('{{$paymentMethod->shortcode->value}}')" class="ki-outline ki-right text-primary fs-1"></i>
                            <x-spinner wire:loading wire:target="select('{{$paymentMethod->shortcode->value}}')" color="primary" />
                        </span>
                    </label>
                @empty
                @endforelse
            </div>

            <div class="separator my-5"></div>

            <div class="gap-5 d-flex justify-content-end">
                <x-button class="btn-light" color="text-muted"
                    {{-- wire:click="cancel" wire:loading wire:target="cancel" --}}
                    data-bs-dismiss="modal" data-bs-target="#deposit-modal"
                    >Close</x-button>
            </div>
        @endif

        @if ($step == 2)
            <form wire:submit="pay">
                @include('payment-methods.index', [
                    'paymentType' => $payment_method
                ])

                <div class="separator my-5"></div>

                <div class="gap-5 d-flex justify-content-end">
                    <x-button class="btn-light" type="button" color="text-muted" wire:click="cancel" wire:loading wire:target="cancel">Cancel</x-button>
                    @if ($paymentMethod->isOnline)
                        <x-button wire:loading wire:target="pay" class="btn-primary">Proceed</x-button>
                    @endif
                </div>
            </form>
        @endif
    </x-modal>

</div>
