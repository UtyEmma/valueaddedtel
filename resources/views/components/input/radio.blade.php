<label {{$attributes->merge(['class' => 'form-check form-check-custom form-check-solid'])->only('class')}}>
    <input class="form-check-input" type="radio" {{ $attributes->except('class') }}/>
    <span class="form-check-label ms-0">
        @isset($label)
            {{$label}}
        @else
            {{$slot}}
        @endisset
    </span>
</label>
