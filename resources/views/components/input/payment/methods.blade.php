@if (in_array($paymentTypes::WALLET->value, $methods))
    <x-input.radio.advanced {{$attributes->except('methods')}}>
        <x-slot:icon><i class="ki-outline ki-wallet fs-1 text-primary"></i></x-slot:icon>
        <x-slot:label>Balance: (<x-currency />{{number_format($authenticated->main_bal, 2)}})</x-slot:label>
        <x-slot:caption></x-slot:caption>
    </x-input.radio.advanced>
@endif

@if (in_array($paymentTypes::PAYSTACK->value, $methods))
    <x-input.radio.advanced {{$attributes->except('methods')}}>
        <x-slot:icon><img class="rounded img-fluid" src="{{asset('assets/brands/paystack.jpeg')}}" /></x-slot:icon>
        <x-slot:label>Paystack</x-slot:label>
    </x-input.radio.advanced>
@endif
