<span wire:ignore x-data="{
    tagify: null,
    tags: @js($value ?? [])
}">

    <input
        x-init="
            tagify = new Tagify($refs.tagifyElement, {
                placeholder: '{{$placeholder ?? `Click Enter to Seperate tags`}}',
                whitelist: @js($whitelist ?? []),
                dropdown: {
                    classname: 'color-blue',
                    enabled: 0,
                    position: 'text',        
                    closeOnSelect: false, 
                    highlightFirst: true
                },
                @isset($mode)
                mode: @js($mode),
                @endisset
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value)
            });

            tagify.addTags(tags);
        "
        x-on:change="
            $dispatch('input', $event.target.value);
            {{-- $wire.set('{{$name}}', $event.target.value); --}}
        "
    x-ref="tagifyElement" {{$attributes->merge(['class' => 'form-control form-control-solid border', 'id' => 'tagify-input'])->except(['whitelist', ':whitelist'])}} />
</span>


