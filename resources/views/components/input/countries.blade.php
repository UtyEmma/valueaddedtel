<span x-data="{
    optionFormat: () => {
        if ( !item.id ) return item.text;
        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-image');
        var template = '';
        template += '<img src="' + imgUrl + '" class="rounded-circle w-20px h-20px me-2" alt="image"/>';
        template += item.text;
        span.innerHTML = template;
        return $(span);
    }
}">
    <x-input.select {{$attributes}} template parent="{{$parent ?? ''}}" class="select-country" placeholder="{{$placeholder ?? 'Select a Country'}}" :name="$name"
        >
        @forelse ($countries->has('supported')->get() as $country)
            <option @selected(($value ?? null) == $country->name) value="{{$country->iso_code}}" data-image="{{asset($country->flag)}}">
                {{$country->name}}
            </option>
        @empty
        @endforelse
    </x-input.select>
</span>

{{-- @pushOnce('scripts')
    <script>
        var optionFormat = function(item) {
            if ( !item.id ) return item.text;

            var span = document.createElement('span');
            var imgUrl = item.element.getAttribute('data-country');
            var template = '';

            template += '<img src="' + imgUrl + '" class="rounded-circle w-20px h-20px me-2" alt="image"/>';
            template += item.text;
            span.innerHTML = template;

            return $(span);
        }

        $('.select-country').select2({
            templateSelection: optionFormat,
            templateResult: optionFormat,
        });
    </script>
@endPushOnce --}}
