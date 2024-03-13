<style>
    .code-input{
        letter-spacing: 10px;
        appearance: none !important;
    }

    .code-input::-webkit-outer-spin-button,
    .code-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    .code-input[type=number] {
    -moz-appearance: textfield;
    }

    .code-input::placeholder{
        letter-spacing: normal;
    }
</style>

<x-input type="number   " placeholder="6 digit code" wire:model="code" autocomplete="off" class="text-center form-control-lg code-input fs-3 fw-bold" />
