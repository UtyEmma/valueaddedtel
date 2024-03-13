<div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body p-md-10">
                    <div class="row g-10">
                        <div class="col-md-7 ">
                            <div >
                                <div>
                                    <div class="mb-8 fw-row">
                                        <x-input.label>Select Network</x-input.label>
                                        <div class="row row-cols-md-4 row-cols-3 g-3">
                                            @forelse ($service->products as $product)
                                                <div>
                                                    <label type="button" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">{{$product->name}}</label>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                        <x-input.error key="network" />
                                    </div>

                                    <div class="mb-8 fw-row">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <x-input.label>Phone Number</x-input.label>
                                            <a href="#">Select Beneficiary</a>
                                        </div>
                                        <x-input type="tel" wire:model="phone" placeholder="Phone Number" />
                                        <x-input.error key="phone" />
                                    </div>

                                    <div class="mb-10 fw-row">
                                        <x-input.label>Amount</x-input.label>
                                        <div class="gap-5 mb-5 d-flex flex-stack">
                                            <button type="button" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">10</button>
                                            <button type="button" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">50</button>
                                            <button type="button" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">100</button>
                                        </div>
                                        <x-input.price type="tel" name="amount" wire:model="amount" placeholder="Amount" />
                                        <x-input.error key="amount" />
                                    </div>

                                    <div class="mt-8">
                                        <x-button class="btn-primary">Make Payment</x-button>
                                    </div>
                                </div>

                                <div class="mt-10 alert alert-success">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est incidunt dignissimos vel dolore, excepturi explicabo nemo amet eos? Saepe, nesciunt.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div>
                                <h4>Transaction History</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
