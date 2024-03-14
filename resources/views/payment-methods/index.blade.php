@if ($paymentType == $paymentTypes::PAYSTACK->value)
    @include('payment-methods.partials.paystack')
@endif

@if ($paymentType == $paymentTypes::WALLET->value)
    @include('payment-methods.partials.wallet')
@endif

@if ($paymentType == $paymentTypes::MANUAL_TRANSFER->value)
    @include('payment-methods.partials.manual')
@endif
