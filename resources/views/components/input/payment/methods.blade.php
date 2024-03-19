@if (in_array($paymentTypes::WALLET->value, $methods))
    @php
        $disabled = $amount ? $amount > $authenticated->main_bal : $authenticated->main_bal < 0;
    @endphp
    <x-input.radio.advanced {{$attributes->except('methods')->merge([
        'value' => $paymentTypes::WALLET->value
    ])}}

    :disabled="$disabled"

    >
        <x-slot:icon>
            <i class="ki-outline ki-wallet fs-1 text-primary"></i>
        </x-slot:icon>
        <x-slot:label>
            <p class="mb-0 lh-1">Balance: (<x-currency />{{number_format($authenticated->main_bal, 2)}})</p>
            @if ($disabled)
                <x-swal class="mb-0 fs-7 fw-semibold lh-1" title="You are exiting your current purchase. Are you sure you wish to proceed?"  href="#">Fund Wallet</x-swal>
            @endif
        </x-slot:label>
        <x-slot:caption></x-slot:caption>
    </x-input.radio.advanced>
@endif

@if (in_array($paymentTypes::PAYSTACK->value, $methods))
    <x-input.radio.advanced {{$attributes->except('methods')->merge([
        'value' => $paymentTypes::PAYSTACK->value
    ])}}>
        <x-slot:icon><img class="rounded img-fluid" src="{{asset('assets/brands/paystack.jpeg')}}" /></x-slot:icon>
        <x-slot:label>Paystack</x-slot:label>
    </x-input.radio.advanced>
@endif
