<div class="modal fade" id="{{$id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" >
    <div class="modal-dialog text-start w-md-450px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mb-5">Confirm your purchase details</h3>
                {{-- <div class="p-2 alert alert-warning">
                    Please note that there might be a network delay on your MTN airtime purchases.
                </div> --}}
                <div >
                    <table class="table table-sm fs-6">
                        <tr>
                            <td class="fw-bold">Phone Number</td>
                            <td class="text-muted text-end">+234 903 870 5881</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Network</td>
                            <td class="text-muted text-end">MTN</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-bold">Amount</td>
                            <td class="w-50 text-muted text-end"><x-currency /> 10,000</td>
                        </tr>
                        {{-- <tr>
                            <td class="fw-bold">Service</td>
                            <td class="text-muted text-end">Airtime Top up</td>
                        </tr> --}}
                        {{-- <tr>
                            <td class="fw-bold">Narration</td>
                            <td class="text-muted text-end">Airtime Purchase</td>
                        </tr> --}}
                        <tr>
                            <td class="fw-bold">Cashback</td>
                            <td class="text-muted text-end">
                                <span class="text-success">+<x-currency/>10</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="my-5 separator"></div>

                <div class="">
                    <h6 class="mb-3">Select Payment Method</h6>
                    <div>
                        <x-input.payment.methods :methods="[]" name="payment_method" />
                    </div>
                </div>

                <div class="my-5 separator"></div>

                <div class="gap-5 d-flex justify-content-end">
                    <x-button data-bs-dismiss="modal" class="btn-light">Cancel</x-button>
                    <x-button class="px-10 btn-primary">Pay</x-button>
                </div>
            </div>
        </div>
    </div>
</div>
