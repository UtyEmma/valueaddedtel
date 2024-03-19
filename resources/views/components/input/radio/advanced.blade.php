<label class="mb-5 d-flex flex-stack {{$disabled ?? false ? 'cursor-default' : 'cursor-pointer'}}" >
    <span class="gap-3 d-flex align-items-center me-2">
        <span class="symbol symbol-40px">
            <span class="symbol-label bg-light-primary">
                {{$icon}}
            </span>
        </span>
        <span class="d-flex flex-column">
            @isset($label)
                <span class="mb-0 text-gray-700 fw-bold fs-6">{{$label}}</span>
            @endisset
            @isset($caption)
                <span class="fs-7 text-muted">{{$caption}}</span>
            @endisset
        </span>
    </span>

    <span class="form-check form-check-custom form-check-solid">
        <input class="form-check-input" type="radio" @disabled($disabled ?? false) {{$attributes->except(['icon', 'label', 'caption', 'disabled'])}}/>
    </span>
</label>
