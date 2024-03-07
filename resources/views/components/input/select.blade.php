<span wire:ignore x-data>
    <style>
        .form-select{
            pointer-events: auto !important
        }
    </style>
    <select x-init="
        $($el).select2({
            placeholder: `{{$placeholder ?? 'Select an Option'}}`,
            minimumResultsForSearch: @isset($search) null @else Infinity @endisset,
            multiple: @js(isset($multiple)),
            allowClear: @js(isset($clearable)),
            closeOnSelect: true,
            minimumResultsForSearch: @js($maxSearchable ?? 0),
            tags: @js(isset($tags)),
            @isset($parent)
                @if (!empty($parent))
                    dropdownParent: $('#{{$parent}}')
                @endif
            @endisset
        });

        $($el).on('change',
            (e) => $wire.set(e.target.name, $(e.target).select2('val'))
        );

    " {{$attributes->merge(['class' => 'form-select bg-transparent border'])}}  {{$attributes}}  >
        {{$slot}}
    </select>
</span>
