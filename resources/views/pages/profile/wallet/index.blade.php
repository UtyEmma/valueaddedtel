<x-dashboard-layout
    title="Wallet"
    :breadcrumbs="[
        ['title' => 'Overview', 'href' => route('dashboard')],
        ['title' => 'Wallet']
    ]"
>
    <div>
        <div class="row g-xxl-9">
            <!--begin::Col-->
            <div class="col-xxl-8">
                <!--begin::Earnings-->
                <div class="mb-5 card card-xxl-stretch mb-xxl-10">
                    <div class="card-body">
                        <div class="mb-5">
                            <h3>Earnings</h3>
                            <span class="text-gray-600 fs-5 fw-semibold d-block">Last 30 day earnings calculated. Apart from arranging the order of topics.</span>
                        </div>

                        <div class="flex-wrap mb-5 d-flex justify-content-between">
                            <div class="flex-wrap d-flex">
                                <div class="p-4 px-5 my-3 border border-gray-300 min-w-200px border-dashed rounded me-6">
                                    <span class="text-gray-800 fs-2x fw-bold lh-1">
                                        <span><x-currency /> {{number_format($authenticated->main_bal, 2)}}</span>
                                    </span>
                                    <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Main Balance</span>
                                </div>
                                <div class="p-4 px-5 my-3 border border-gray-300 min-w-200px border-dashed rounded me-6">
                                    <span class="text-gray-800 fs-2x fw-bold lh-1">
                                        <span><x-currency /> {{number_format($authenticated->cashback_bal, 2)}}</span>
                                    </span>
                                    <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Cashback</span>
                                </div>
                                <div class="p-4 px-5 my-3 border border-gray-300 min-w-200px border-dashed rounded">
                                    <span class="text-gray-800 fs-2x fw-bold lh-1">
                                        <span><x-currency /> {{number_format($authenticated->bonus_bal, 2)}}</span>
                                    </span>
                                    <span class="pt-2 text-gray-500 fs-6 fw-semibold d-block lh-1">Referral Bonus</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="gap-5 d-flex">
                                <x-button class="btn-success" data-bs-toggle='modal' data-bs-target="#deposit-modal">Fund Wallet<i class="ki-"></i></x-button>
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
                            <th class="min-w-175px ps-9">Reference</th>
                            <th class="px-0 min-w-250px">Purpose</th>
                            <th class="min-w-175px">Amount</th>
                            <th class="min-w-175px">Payment Method</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-center min-w-125px">Date</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-600 fs-6 fw-semibold">
                        @forelse ($authenticated->transactions as $transaction)
                            <tr x-data="{
                                reference: @js($transaction->reference),
                                copy: 'Copy',
                                copyReference(){
                                    windows.navigator.clipboard.writeText(this.reference)
                                    this.copy = 'Copied';
                                    setTimeout(() => this.copy = 'Copy', 2000)
                                }
                            }">
                                <td class="ps-9" >{{$transaction->reference}} <x-button x-text="copy" x-on:click="copyReference"></x-button> </td>
                                <td class="ps-0">{{$transaction->narration}}</td>
                                <td>Darknight transparency 36 Icons Pack</td>
                                <td class="text-success">{{$transaction->paymentMethod->name}}</td>
                                <td class="text-success"><x-currency /> {{number_format($transaction->amount, 2)}}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{$paymentStatuses::color($transaction->status)}}">{{$transaction->status}}</span>
                                </td>
                                <td class="text-center">
                                    {{Date::parse($transaction->created_at)->format('jS M Y h:i A')}}
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                    <!--end::Tbody-->
                </x-table>
            </div>
        </div>
    </div>
</x-dashboard-layout>
