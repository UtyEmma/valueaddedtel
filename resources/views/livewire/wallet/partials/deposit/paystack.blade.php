<div class="fv-row">
    <x-input.label>Amount</x-input.label>
    <x-input.price wire:model="amount" name="amount" />
    <x-input.error key="amount" />
</div>

<div class="my-7 separator"></div>

<div class="gap-5 d-flex justify-content-end">
    <x-button class="btn-light" data-bs-dismiss="modal">Cancel</x-button>
    <x-button class="btn-primary">Proceed with Paystack</x-button>
</div>
