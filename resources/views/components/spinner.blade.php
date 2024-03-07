<span {{ $attributes->whereStartsWith('wire:')->except('class')}} class="spinner-border spinner-border-sm text-{{$color ?? 'white'}} {{$class ?? ''}}"  role="status">
    <span class="visually-hidden">Loading...</span>
</span>
