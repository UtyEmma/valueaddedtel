@props([
    'left',
    'right',
    'showPadding',
    'spanClass' => '',
    'groupClass' => ''
])

<div class="input-group bg-transparent border-gray-500 {{$groupClass}}">
    @isset($left)
        <span class="border-gray-200  input-group-text fs-6 bg-transparent border-right-0 {{$spanClass}} {{isset($showPadding) ? '' : 'pe-0'}}" >{{$left}}</span>
    @endisset
    <x-input type="text" class="form-control bg-transparent fs-6 {{($left ?? null) ? 'border-start-0' : ''}} {{($right ?? null) ? 'border-end-0' : ''}}" {{$attributes}} />
    @isset($right)
        <span class="border-gray-200  input-group-text bg-transparent border-left-0 fs-6 {{$spanClass}} {{isset($showPadding) ? '' : 'ps-0'}}" >{{$right}}</span>
    @endisset
</div>
