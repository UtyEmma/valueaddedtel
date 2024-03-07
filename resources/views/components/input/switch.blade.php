<label {{$attributes->class('form-check form-switch form-check-custom form-check-solid')}}>
    <input class="form-check-input" {{ $attributes->except('class') }} type="checkbox" />
    <span class="form-check-label">
        {{$slot}}
    </span>
</label>
