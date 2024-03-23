<div>
    <div class="row g-xxl-9">
        <div class="col-xxl-8">
            <div class="mb-5 card card-xxl-stretch mb-xxl-10">
                <div class="card-body">
                    <div class="mb-5">
                        <h3>Earnings</h3>
                        <span class="text-gray-600 fs-5 fw-semibold d-block">Last 30 day earnings calculated. Apart from arranging the order of topics.</span>
                    </div>

                    <div class="flex-wrap mb-5 d-flex justify-content-between">
                        <div class="flex-wrap gap-4 d-flex">
                            <div class="p-4 border border-gray-300 border-dashed rounded w-100 w-md-200px">
                                <span class="text-gray-800 fs-2 fw-bold lh-1">
                                    <span><x-currency /> {{number_format($authenticated->wallet->main_bal, 2)}}</span>
                                </span>
                                <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Main Balance</span>
                            </div>
                            <div class="p-4 border border-gray-300 border-dashed rounded w-100 w-md-200px">
                                <span class="text-gray-800 fs-2 fw-bold lh-1">
                                    <span><x-currency /> {{number_format($authenticated->wallet->cashback_bal, 2)}}</span>
                                </span>
                                <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Cashback</span>
                            </div>
                            <div class="p-4 border border-gray-300 border-dashed rounded w-100 w-md-200px">
                                <span class="text-gray-800 fs-2 fw-bold lh-1">
                                    <span><x-currency /> {{number_format($authenticated->wallet->bonus_bal, 2)}}</span>
                                </span>
                                <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Referral Bonus</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="gap-5 d-flex">
                            <x-button class="w-full btn-success" data-bs-toggle='modal' data-bs-target="#deposit-modal">Fund Wallet<i class="ki-"></i></x-button>
                            <x-button class="btn-primary">Send Money</x-button>
                        </div>

                        <x-button class="flex-shrink-0 btn-light-primary">Withdraw Funds</x-button>
                    </div>
                </div>

                <livewire:wallet.deposit />
            </div>
        </div>

        <div class="col-xxl-4">
            <div class="mb-5 card card-xxl-stretch mb-xxl-10">
                <div class="card-body">
                    <div>
                        <h3 class="text-gray-800">Accumulated Points (PV)</h3>
                        <p class="text-gray-600 fs-6 fw-semibold">Febuary Accumulated Points</p>
                    </div>

                    <div class="gap-5 d-flex flex-column">
                        <div class="p-4 px-5 border border-gray-300 border-dashed rounded">
                            <span class="text-gray-800 fs-1 fw-bold lh-1">
                                <span>{{number_format($authenticated->accumulated_pv, 2)}}<span class="fs-6">PV</span></span>
                            </span>
                            <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Accumulated Points</span>
                        </div>
                        <div class="p-4 px-5 border border-gray-300 border-dashed rounded">
                            <span class="text-gray-800 fs-1 fw-bold lh-1">
                                <span>{{number_format($authenticated->total_pv, 2)}}<span class="fs-6">PV</span></span>
                            </span>
                            <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Lifetime Accumulated Points</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="text-gray-800">Transaction History</h3>
            </div>

            <x-table >
                <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                    <tr>
                        <th>Reference</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <td></td>
                    </tr>
                </thead>

                <tbody class="text-gray-600 fs-6 fw-semibold">
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="gap-3 d-flex align-items-center">
                                {{$transaction->reference}}
                                <x-copy :text="$transaction->reference">
                                    <span x-on:click="console.log('ams')" x-text="label" class="cursor-pointer badge badge-light-primary"></span>
                                </x-copy>
                            </td>
                            <td>{{$transaction->narration}}</td>
                            <td><x-currency /> {{number_format($transaction->amount, 2)}}</td>
                            <td>{{$transaction->paymentMethod->name}}</td>
                            <td>
                                <span class="badge badge-{{$paymentStatuses::color($transaction->status)}}">{{$transaction->status}}</span>
                            </td>
                            <td class="text-center">
                                {{Date::parse($transaction->created_at)->format('jS M Y h:i A')}}
                            </td>
                            <td>
                                <x-button class="btn-sm btn-light-primary">View</x-button>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </x-table>

            {{$transactions->links()}}
        </div>
    </div>
</div>
