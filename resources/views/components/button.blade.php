<button {{ $attributes->merge(['class' => 'btn'])->except(['wire:loading', 'wire:target']) }}>
    {{ $slot }} @if ($attributes->has('wire:loading')) <x-spinner {{$attributes->only(['wire:loading', 'wire:target'])}} />@endif
</button>
