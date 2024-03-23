<div>
    <div class="row g-10">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body p-md-10 py-md-20">
                    <div class="mx-auto col-md-8">
                        <div class="mb-8">
                            <h2>Airtime Top Up</h2>
                        </div>
                        <form wire:submit="initiate" x-data="{
                            selectedAmount: null,
                            selectedNetwork: null
                        }">
                            <div >
                                <div>
                                    <div class="fv-row mb-7">
                                        <x-input.label>Select Network</x-input.label>
                                        <div class="flex-wrap gap-5 d-flex ">
                                            @forelse ($products as $product)
                                                <div>
                                                    <label x-bind:class="selectedNetwork == '{{$product->shortcode}}' ? 'border-primary' : 'border-light'"  style="transition: all; transition-duration: 300ms;"  class="border cursor-pointer border-3 symbol symbol-md-70px symbol-50px overlay overlay-block">
                                                        <div class="z-50 rounded symbol-label position-relative" :style="selectedNetwork == '{{$product->shortcode}}' ? {scale: '0.9'} : {}" style="background-image:url('{{$product->logo}}'); border-radius: 5px !important; transition: all; transition-duration: 300ms;" >
                                                            {{-- <i x-show="selectedNetwork == '{{$product->shortcode}}'" x-cloak class="z-50 text-white bi bi-check-circle-fill fs-3 position-absolute" style="top: 3px; right: 3px;"></i> --}}
                                                            <input type="radio" wire:model.live="network" value="{{$product->shortcode}}" x-on:change="selectedNetwork = $event.target.value" hidden>
                                                        </div>
                                                        {{-- <div x-cloak x-show="selectedNetwork == '{{$product->shortcode}}'" class="bg-black bg-opacity-75 overlay-layer"></div> --}}
                                                    </label>
                                                </div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>


                                    <div class="mb-7 fw-row">
                                        <x-input.label>Phone Number</x-input.label>
                                        <x-input type="tel" wire:model="phone" placeholder="0903 870 5881" />
                                        <x-input.error key="phone" />
                                    </div>

                                    <div class="mb-7 fw-row">
                                        <x-input.label>Amount</x-input.label>
                                        <x-input.price type="tel" name="amount" x-init="
                                            $watch('selectedAmount', (value) => amount = value)
                                            $watch('amount', (value) => selectedAmount = value)
                                        " wire:model="amount" placeholder="Amount" />

                                        <div class="gap-3 mt-2 d-flex">
                                            @forelse ($countryService->values as $amount)
                                                <div>
                                                    <x-button type="button" x-on:click="selectedAmount = {{$amount}};"  class="p-3 px-5 text-center h-100 btn justify-content-center w-100 fw-bold" x-bind:class="selectedAmount == {{$amount}} ? 'bg-light-primary border border-2 border-primary' : 'btn-light'"><x-currency />{{number_format($amount)}}</span></x-button>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>

                                        <x-input.error key="amount" />
                                    </div>

                                    {{-- <div class="mb-5 fw-row" >
                                        <x-input.label>Select Network</x-input.label>
                                        <x-input.service wire:model="network" :products="$products" />
                                        <x-input.error key="network" />
                                    </div> --}}

                                    <div class="mt-8">
                                        <x-button type="submit" wire:loading wire:target="initiate" class="btn-primary w-100">Next</x-button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @include('components.modals.confirm', [
                            'methods' => $methods,
                            'id' => 'confirm-modal'
                        ])

                        @include('gateways.index')
                        {{-- <livewire:payment.checkout /> --}}
                        {{-- <x-modals.confirm :methods="$methods" id="confirm-modal" /> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>


</div>
