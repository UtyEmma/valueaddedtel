@props([
    'digits' => 4,
    'type' => 'number',
    'value' => '',
    'placeholder' => "•",
    'name' => ''
])

@php
    $entries = $value ? explode('', $value) : [];
@endphp

<div
    class="d-flex justify-content-between"
    x-data="{
        value: @js($value),
        entries: @js($entries),
        current: 0,
        length: @js($digits),
        input: null,
        next(position){
            if(position >= this.length) return this.current = 0;
            this.current = position + 1;
        },
        previous(position){
            if(position < 0) return this.current = 0;
            this.current = position - 1;
        },
        set($event, position){
            const value = $event.target.value;
            const currentPos = this.entries[position];

            if(value?.length > 1) {
                $event.target.value = this.entries[position];
                return this.next(position);
            }

            this.entries[position] = value;
            this.value = this.entries.join('');

            if(value){
                this.next(position)
            }else{
                this.previous(position)
            }
        },
        pasteText(event){
            let pasted = event.clipboardData.getData('text');
            pasted = pasted.replace(/\D/g, '');
            pasted = pasted.substring(0, this.length);
            if (pasted) this.entries = pasted.split('');
        }
    }"
    x-init="
        $watch('value', (value) => {
            for (const name of $refs.input.getAttributeNames()) {
                if(name.includes('wire:model')) {
                    $wire.set($refs.input.getAttribute(name), value);
                }
            }
        })
    "
>
    @for ($x = 0; $x < $digits; $x++)
        <x-input
            maxlength="1"
            type="{{$type}}"
            x-bind:value="entries[position]"
            x-data="{
                position: {{$x}},
            }"
            x-on:input="set($event, position)"
            x-on:paste.prevent="pasteText(event)"
            x-init="
                $watch('current', () => {
                    if(current > length && position == 0) return $el.focus();
                    if(current == position) return $el.focus();
                })
            "
            placeholder="{{$placeholder}}"
            class="w-50px appearance-none h-50px text-center fs-1"
        />
    @endfor

    <x-input x-bind:value="value" x-ref="input" hidden name="{{$name}}" {{$attributes->whereStartsWith('wire:model')}} />
</div>
