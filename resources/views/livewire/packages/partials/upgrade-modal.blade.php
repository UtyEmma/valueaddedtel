<x-modal id="{{$id}}" class="w-450px" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="text-center">
        @if ($selectedPackage)
            <div class="mb-10">
                <h3 class="fw-bolder">Upgrade to {{$selectedPackage->name}}</h3>
            </div>

            <div class="">
                <div class="text-start ">
                    <p class="mb-2 text-black fs-6 fw-bold">What you will get:</p>
                    <div class="mb-4 separator separator-dashed"></div>
                </div>

                <div class="gap-3 text-muted d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold">Upgrade Bonus</p>
                        <p class="mb-0 text-end"><x-currency/>{{number_format($selectedPackage->bonus, 2)}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold">Max Comission Level</p>
                        <p class="mb-0 text-end">{{$selectedPackage->max_level}} {{str('level')->plural($selectedPackage->max_level)}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold">Point Value</p>
                        <p class="mb-0 text-end">{{$selectedPackage->point_value}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold">Earn Cashback</p>
                        <p class="mb-0 text-end">
                            @if ($selectedPackage->cashback)
                                <span class="badge badge-light-primary">Yes</span>
                            @else
                                <span class="badge badge-light">No</span>
                            @endif
                        </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold">Amount to pay</p>
                        <p class="mb-0 text-end"><x-currency/>{{number_format($selectedPackage->currentPackageDiff(), 2)}}</p>
                    </div>

                    <p class="mb-0 fs-7 text-start">The amount to pay is the difference between the fee for your current plan and your new plan</p>
                </div>
            </div>

            <div class="my-5 separator separator-dashed"></div>

            <div class="mb-5">
                <div class="gap-4 mb-5 d-flex align-items-center me-2">
                    <div>
                        <div class="symbol symbol-50px">
                            <div class="symbol-label bg-light-primary">
                                <i class="ki-duotone ki-wallet fs-2x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column text-start">
                        <p class="mb-0 fw-bold fs-6">Wallet Balance</p>
                        <p class="mb-0 text-muted"><x-currency />{{number_format($authenticated->wallet->main_bal, 2)}}</p>
                    </div>
                </div>

                @if ($selectedPackage->currentPackageDiff() > $authenticated->wallet->main_bal)
                    <div class="p-2 alert alert-warning">
                        You do not have sufficient funds in your wallet to complete this purchase.
                        <x-swal class="mb-0 fw-semibold" href="{{route('profile.wallet')}}">Fund Wallet</x-swal>
                    </div>
                @endif
            </div>

            <div>
                <x-button wire:loading wire:target="upgrade" wire:click="upgrade" class="mb-3 w-100 btn-success">Upgrade to {{$selectedPackage->name}}</x-button>
                <x-button class="px-10 btn-light" wire:loading.attr="disabled" wire:target="upgrade" data-bs-dismiss="modal">Close</x-button>

            </div>

        @endif
    </div>
</x-modal>
