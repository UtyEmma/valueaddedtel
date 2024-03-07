@error($key)
    <p {{$attributes->merge(['class' => 'text-danger mb-0'])}}>{{$message}}</p>
@enderror
