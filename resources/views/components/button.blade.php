<button {{ $attributes->merge(['class' => 'btn'])->except(['wire:loading', 'color']) }}>
    {{ $slot }} @if ($attributes->has('wire:loading')) <x-spinner {{$attributes->only(['wire:loading', 'wire:target', 'color'])}} />@endif
</button>
