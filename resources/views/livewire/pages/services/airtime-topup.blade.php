<div>
    <div class="row g-10">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body p-md-10 py-md-20">
                    <div class="mx-auto col-md-8">
                        <div class="mb-8">
                            <h2>Buy Airtime</h2>
                        </div>
                        <form wire:submit="initiate" x-data="{
                            selectedAmount: null
                        }">
                            <div >
                                <div>
                                    <div class="mb-5 fv-row">
                                        <x-input.label>Select Amount</x-input.label>
                                        <div class="row row-cols-4 g-2">
                                            <div>
                                                <x-button type="button" x-on:click="selectedAmount = 100;"  class="p-3 text-center h-100 btn justify-content-center w-100" x-bind:class="selectedAmount == 100 ? 'bg-light-primary border border-2 border-primary' : 'btn-light'"><x-currency />100</span></x-button>
                                            </div>
                                            <div>
                                                <x-button type="button" x-on:click="selectedAmount = 200" class="p-3 text-center h-100 btn justify-content-center w-100" x-bind:class="selectedAmount == 200 ? 'bg-light-primary border border-2 border-primary' : 'btn-light'"><x-currency />200</x-button>
                                            </div>
                                            <div>
                                                <x-button type="button" x-on:click="selectedAmount = 500" class="p-3 text-center h-100 btn justify-content-center w-100" x-bind:class="selectedAmount == 500 ? 'bg-light-primary border border-2 border-primary' : 'btn-light'"><x-currency />500</x-button>
                                            </div>
                                            <div>
                                                <x-button type="button" x-on:click="selectedAmount = 1000"  class="p-3 text-center h-100 btn justify-content-center w-100" x-bind:class="selectedAmount == 1000 ? 'bg-light-primary border border-2 border-primary' : 'btn-light'"><x-currency />1,000</x-button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mb-5 fw-row">
                                        <x-input.label>Amount</x-input.label>
                                        <x-input.price type="tel" name="amount" x-init="
                                            $watch('selectedAmount', (value) => amount = value)
                                            $watch('amount', (value) => selectedAmount = value)
                                        " wire:model="amount" placeholder="Amount" />
                                        <x-input.error key="amount" />
                                    </div>

                                    <div class="mb-5 fw-row" >
                                        <x-input.label>Select Network</x-input.label>
                                        <x-input.service wire:model="network" :products="$products" />
                                        <x-input.error key="network" />
                                    </div>

                                    <div class="mb-5 fw-row">
                                        <x-input.label>Phone Number</x-input.label>
                                        <x-input type="tel" wire:model="phone" placeholder="0903 870 5881" />
                                        <x-input.error key="phone" />
                                    </div>

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
