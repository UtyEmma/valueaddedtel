<div x-data="{
    optionFormat: (item) => {
        if ( !item.id ) return item.text;
        var span = document.createElement('span');
        var imgUrl = item.element.getAttribute('data-image');
        var template = '';
        template += `<img src='${imgUrl}' class='rounded w-25px h-25px me-2' alt='image'/>`;
        template += item.text;
        span.innerHTML = template;
        return $(span)
    }
}">
    <x-input.select placeholder="Select Network" {{$attributes}} templates >
        <option value=""></option>
        @forelse ($products as $product)
            <option @selected(($value ?? null) == $product->shortcode) value="{{$product->shortcode}}" data-image="{{$product->logo}}">
                {{$product->name}}-{{$product->country->iso_code}}
            </option>
        @empty
        @endforelse
    </x-input.select>
</div>
