@props([
    'min' => 0,
    'max' => null,
    'value' => 0,
    'step' => 1,
    'ref' => null,
    'event' => 'dailer:updated',
    'onchange' => ''
])

<div {{$attributes->class('input-group input-group-solid w-auto')}} 
        x-data="{
            min: @js((int) $min),
            max: @js((int) $max),
            value: @js((int) $value),
            step: @js((int) $step),
            dailer: null,
            increment(){
                this.value += this.step;
            },
            decrement(){
                if(this.min < this.value) this.value -= this.step;
            },
            update(val){
                this.value = parseInt(val)
            }
        }" x-init="
            $watch('value', value => {
                {!! $onchange !!};
            })
        "
    >

    <button class="btn btn-icon btn-sm btn-outline btn-active-color-primary" x-on:click="decrement()" type="button">
        <i class="ki-duotone ki-minus fs-2"></i>
    </button>

    <x-input class="form-control-sm text-center appearance-none" type="number" :min='$min' x-ref="dailer" x-on:change="update($event.target.value)" x-bind:value="value" {{$attributes->except('class')}} />

    {{-- <input type="text" class="form-control form-control-sm" readonly placeholder="Amount" {{$attributes->except('class')}}  data-kt-dialer-control="input"/> --}}

    <button class="btn btn-icon btn-sm btn-outline btn-active-color-primary" x-on:click="increment()" type="button">
        <i class="ki-duotone ki-plus fs-2"></i>
    </button>
</div>