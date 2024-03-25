<div>

    <div class="row row-cols-md-3 g-10">
        <div>
            @include('livewire.packages.partials.package-item', [
                'package' => $authenticated->package
            ])
        </div>
        @forelse ($packages as $package)
            @if ($package->id != $authenticated->package->id)
                <div>
                    @include('livewire.packages.partials.package-item', [
                        'package' => $package
                    ])
                </div>
            @endif
        @empty
        @endforelse
    </div>

    @include('livewire.packages.partials.upgrade-modal', [
        'id' => 'select-package-modal'
    ])
</div>
