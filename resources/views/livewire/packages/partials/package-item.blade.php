<div class="card">
    <div class="text-center card-body">
        <div class="mb-5">
            <h4 class="fw-bold">{{$package->name}}
                @if ($package->is_default)
                    <span class="badge badge-light-success text-uppercase badge-sm">Default Package</span>
                @else
                    @if ($package->is_highest)
                        <span class="badge badge-light-primary text-uppercase badge-sm">Recommended</span>
                    @endif
                @endif
            </h4>
            <p class="fs-5 fw-semibold text-muted"><x-currency /> {{number_format($package->fee, 2)}}</p>
        </div>

        <div class="text-start ">
            <p class="mb-2 text-black fs-6 fw-bold">What you will get:</p>
            <div class="mb-4 separator separator-dashed"></div>
        </div>

        <div class="gap-3 text-muted d-flex flex-column">
            <div class="d-flex justify-content-between">
                <p class="mb-0 fw-semibold">Upgrade Bonus</p>
                <p class="mb-0 text-end"><x-currency/>{{number_format($package->bonus, 2)}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mb-0 fw-semibold">Max Comission Level</p>
                <p class="mb-0 text-end">{{$package->max_level}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mb-0 fw-semibold">Point Value</p>
                <p class="mb-0 text-end">{{$package->point_value}}</p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="mb-0 fw-semibold">Earn Cashback</p>
                <p class="mb-0 text-end">
                    @if ($package->cashback)
                        <span class="badge badge-light-primary">Yes</span>
                    @else
                        <span class="badge badge-light">No</span>
                    @endif
                </p>
            </div>

        </div>
    </div>

    <div class="py-3 text-center card-footer">
        @if ($package->id == $authenticated->package->id)
            <x-button class="btn-light-success disabled" disabled>Current Package</x-button>
        @else
            <x-button wire:loading wire:target="select('{{$package->id}}')" wire:click="select('{{$package->id}}')" class="btn-primary">Upgrade Package</x-button>
        @endif
    </div>
</div>
