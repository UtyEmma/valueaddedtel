<span wire:ignore x-data>
    <style>
        .form-select{
            pointer-events: auto !important
        }
    </style>
    <select x-init="
        $($el).select2({
            placeholder: `{{$placeholder ?? 'Select an Option'}}`,
            minimumResultsForSearch: @if(isset($search)) null @else Infinity @endif,
            multiple: @js(isset($multiple)),
            allowClear: @js(isset($clearable)),
            closeOnSelect: true,
            minimumResultsForSearch: @js($maxSearchable ?? 0),
            tags: @js(isset($tags)),
            @isset($parent)
                @if (!empty($parent))
                    dropdownParent: $('#{{$parent}}'),
                @endif
            @endisset
            @isset($templates)
                templateSelection: optionFormat,
                templateResult: optionFormat,
            @endisset
        });

        $($el).on('change', (e) => {
            for (const name of e.target.getAttributeNames()) {
                if(name.includes('wire:model')) {
                    $wire.set(e.target.getAttribute(name), $(e.target).select2('val'));
                }
            }
        });

    " {{$attributes->merge(['class' => 'form-select bg-transparent border'])}}  {{$attributes}}  >
        {{$slot}}
    </select>
</span>
