<div class="modal fade" wire:ignore.self id="{{$id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" >
    <div class="modal-dialog text-start w-md-450px modal-dialog-centered">
        <div class="modal-content">
            @if ($step == 1)
                <form wire:submit="pay" class="modal-body">
                    <h3 class="mb-4">Confirm your purchase details</h3>

                    {{-- @if ($warning) --}}
                        <div class="p-2 alert alert-warning fs-7">
                            Please note that there is a delay on your MTN airtime purchases.
                        </div>
                    {{-- @endif --}}

                    <div class="p-5 rounded bg-light" >
                        <div class="gap-2 fs-6 d-flex flex-column">
                            @if ($phone)
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Phone Number</div>
                                    <div class="text-muted text-end">{{$phone}}</div>
                                </div>
                            @endif

                            @if ($product)
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Network</div>
                                    <div class="text-muted text-end">
                                        @if ($product->logo)
                                            <img src="{{$product->logo}}" class="rounded-circle img-fluid w-20px h-20px" style="object-fit: cover;" alt="" />
                                        @endif {{$product->name}}
                                    </div>
                                </div>
                            @endif

                            @if ($amount)
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Amount</div>
                                    <div class="text-muted text-end"><x-currency /> {{number_format($amount, 2)}}</div>
                                </div>
                            @endif

                            @if ($service)
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Narration</div>
                                    <div class="text-muted text-end">{{$service->name}}</div>
                                </div>
                            @endif

                            @if ($product?->cashback)
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">Cashback</div>
                                    <div class="text-muted text-end">
                                        <span class="text-success">+<x-currency/>{{$product->cashbackAmount($amount)}}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="my-5 separator"></div>

                    <div>
                        <div class="gap-4 d-flex align-items-center me-2">
                            <div>
                                <div class="symbol symbol-50px">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="ki-outline ki-wallet fs-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column">
                                <p class="mb-0 fw-bold fs-6">Wallet Balance</p>
                                <p class="mb-0 text-muted">
                                    <x-currency />{{number_format($authenticated->wallet->main_bal, 2)}}
                                </p>
                            </div>
                        </div>

                        @if ($amount > $authenticated->wallet->main_bal)
                            <div class="alert alert-secondary">
                                You do not have sufficient funds in your wallet to complete this purchase.
                                <x-swal class="mb-0 fw-semibold" href="{{route('profile.wallet')}}">Fund Wallet</x-swal>
                            </div>
                        @endif
                    </div>

                    <div class="my-5 separator"></div>

                    <div class="gap-5 d-flex justify-content-end">
                        <button type="button" data-bs-dismiss="modal" wire:loading.attr="disabled" wire:target="pay" wire:click="cancel" class="btn btn-light">Cancel <x-spinner wire:target="cancel" color="muted" wire:loading/></button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="cancel" @disabled($amount > $authenticated->wallet->main_bal) class="px-10 btn btn-primary">Proceed <x-spinner wire:target="pay" wire:loading/></button>
                    </div>
                </form>
            @endif

            @if ($step == 2)
                <form wire:submit="complete"  class="modal-content">
                    <input autocomplete="false" name="hidden" type="text" class="d-none">
                    <div class="modal-body">
                        <h3 class="mb-10 text-center">Enter your payment pin</h3>

                        <div class="px-20 mb-5">
                            <x-input.pin type="password" wire:model="pin" class="justify-content-start" />
                        </div>

                        <div class="text-center">
                            <x-input.error key='pin' />
                        </div>

                        <div class="text-center">
                            <x-swal title="You are exiting your current purchase. Are you sure you wish to proceed?"  href="#">Forgot Payment Pin</x-swal>
                        </div>

                        <div class="my-5 separator"></div>

                        <div class="gap-5 d-flex justify-content-end">
                            <button type="button" wire:click="cancel" wire:loading.attr="disabled" wire:target="complete" class="btn btn-light" >Cancel <x-spinner wire:loading wire:target="cancel" color="primary" /></button>
                            <button type="submit" wire:loading.attr="disabled" wire:target="cancel" class="px-10 btn btn-primary">Pay <x-spinner wire:loading wire:target="complete" color="white" /></button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
