<x-dashboard-layout>
    <div class="mb-5 card mb-xl-10">
        <div class="py-10 card-body">
            <h2 class="mb-9">Referral Program</h2>
            <div class="mb-10 row">
                <div class="col-xl-6 mb-15 mb-xl-0 pe-5">
                    <h4 class="mb-0">How to use Referral Program</h4>
                    <p class="py-4 m-0 text-gray-600 fs-6 fw-semibold">Use images to enhance your post, improve its flow, add humor
                    <br />and explain complex topics</p>
                    <a href="#" class="btn btn-light btn-active-light-primary fw-bold">Get Started</a>
                </div>

                <div class="col-xl-6">
                    <h4 class="mb-0 text-gray-800">Your Referral Link</h4>
                    <p class="py-4 m-0 text-gray-600 fs-6 fw-semibold">Plan your blog post by choosing a topic, creating an outline conduct
                    <br />research, and checking facts</p>
                    <x-copy class="d-flex" :text="$authenticated->referral_link">
                        <input type="text" class="form-control form-control-solid me-3 flex-grow-1" style="user-select: all;" name="search" value="{{$authenticated->referral_link}}" />
                        <button x-on:click="copy" x-text="label" class="flex-shrink-0 btn btn-light btn-active-light-primary fw-bold">Copy</button>
                    </x-copy>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Overview-->
            <!--begin::Stats-->
            <div class="row">
                <!--begin::Col-->
                <div class="col">
                    <div class="p-6 my-3 card card-dashed flex-center min-w-175px">
                        <span class="px-2 pb-1 fs-4 fw-semibold text-info">Referral Commission</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center"><x-currency />
                        <span>{{$authenticated->wallet->bonus_bal}}</span></span>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <div class="p-6 my-3 card card-dashed flex-center min-w-175px">
                        <span class="px-2 pb-1 fs-4 fw-semibold text-success">Direct Referrals</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">$
                        <span>{{$authenticated->refferals->count()}}</span></span>
                    </div>
                </div>
            </div>
            <!--end::Stats-->
            <!--begin::Info-->
            <p class="py-6 text-gray-600 fs-5 fw-semibold">Writing headlines for blog posts is as much an art as it is a science, and probably warrants its own post, but for now, all I’d advise is experimenting with what works for your audience, especially if it’s not resonating with your audience</p>
            <!--end::Info-->
            <!--begin::Notice-->
            <div class="p-6 border border-dashed rounded notice d-flex bg-light-primary border-primary">
                <!--begin::Icon-->
                <i class="ki-duotone ki-bank fs-2tx text-primary me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="flex-wrap d-flex flex-stack flex-grow-1 flex-md-nowrap">
                    <!--begin::Content-->
                    <div class="mb-3 mb-md-0 fw-semibold">
                        <h4 class="text-gray-900 fw-bold">Withdraw Your Money to a Bank Account</h4>
                        <div class="text-gray-700 fs-6 pe-7">Withdraw money securily to your bank account. Commision is $25 per transaction under $50,000</div>
                    </div>
                    <!--end::Content-->
                    <!--begin::Action-->
                    <a href="#" class="px-6 btn btn-primary align-self-center text-nowrap">Withdraw Money</a>
                    <!--end::Action-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Notice-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Referral program-->
    <!--begin::Referred users-->
    <div class="card">
        <!--begin::Header-->
        <div class="card-header card-header-stretch">
            <!--begin::Title-->
            <div class="card-title">
                <h3>Referred Users</h3>
            </div>
            <!--end::Title-->
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <!--begin::Tab nav-->
                <ul class="border-transparent nav nav-stretch fs-5 fw-semibold nav-line-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a id="kt_referrals_tab_1" class="nav-link text-active-gray-800 me-4 active" data-bs-toggle="tab" role="tab" href="#kt_referrals_1">Month</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="kt_referrals_tab_2" class="nav-link text-active-gray-800 me-4" data-bs-toggle="tab" role="tab" href="#kt_referrals_2">2022</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="kt_referrals_tab_3" class="nav-link text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_referrals_3">2021</a>
                    </li>
                </ul>
                <!--end::Tab nav-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header-->
        <!--begin::Tab content-->
        <div id="kt_referred_users_tab_content" class="tab-content">
            <!--begin::Tab panel-->
            <div id="kt_referrals_1" class="p-0 card-body tab-pane fade show active" role="tabpanel">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-bordered gy-6">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 border-bottom fs-6 fw-bold bg-lighten">
                            <tr>
                                <th class="min-w-125px ps-9">Order ID</th>
                                <th class="px-0 min-w-125px">User</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Bonus</th>
                                <th class="min-w-125px ps-0">Profit</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="text-gray-600 fs-6 fw-semibold">
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Marcus Harris</a>
                                </td>
                                <td>Nov 24, 2020</td>
                                <td>26%</td>
                                <td class="text-success">$1,200.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">578433345</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Maria Garcia</a>
                                </td>
                                <td>Aug 10, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$2,400.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Robert Smith</a>
                                </td>
                                <td>May 06, 2020</td>
                                <td>18%</td>
                                <td class="text-success">$940.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">098669322</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Williams Brown</a>
                                </td>
                                <td>Apr 30, 2020</td>
                                <td>43%</td>
                                <td class="text-success">$200.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">245899092</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Paul Johnson</a>
                                </td>
                                <td>Feb 29, 2020</td>
                                <td>21%</td>
                                <td class="text-success">$380.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">505432578</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Sarah Jones</a>
                                </td>
                                <td>Jan 08, 2020</td>
                                <td>47%</td>
                                <td class="text-success">$2,050.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">256899235</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Juan Carlos</a>
                                </td>
                                <td>Jan 02, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$820.00</td>
                            </tr>
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Tab panel-->
            <!--begin::Tab panel-->
            <div id="kt_referrals_2" class="p-0 card-body tab-pane fade" role="tabpanel">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-bordered gy-6">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 border-bottom fs-6 fw-bold bg-lighten">
                            <tr>
                                <th class="min-w-125px ps-9">Order ID</th>
                                <th class="px-0 min-w-125px">User</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Bonus</th>
                                <th class="min-w-125px ps-0">Profit</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="text-gray-600 fs-6 fw-semibold">
                            <tr>
                                <td class="ps-9">256899235</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Juan Carlos</a>
                                </td>
                                <td>Jan 02, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$820.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">245899092</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Paul Johnson</a>
                                </td>
                                <td>Feb 29, 2020</td>
                                <td>21%</td>
                                <td class="text-success">$380.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">505432578</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Sarah Jones</a>
                                </td>
                                <td>Jan 08, 2020</td>
                                <td>47%</td>
                                <td class="text-success">$2,050.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Robert Smith</a>
                                </td>
                                <td>May 06, 2020</td>
                                <td>18%</td>
                                <td class="text-success">$940.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">578433345</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Maria Garcia</a>
                                </td>
                                <td>Aug 10, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$2,400.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">098669322</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Williams Brown</a>
                                </td>
                                <td>Apr 30, 2020</td>
                                <td>43%</td>
                                <td class="text-success">$200.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Marcus Harris</a>
                                </td>
                                <td>Nov 24, 2020</td>
                                <td>26%</td>
                                <td class="text-success">$1,200.00</td>
                            </tr>
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Tab panel-->
            <!--begin::Tab panel-->
            <div id="kt_referrals_3" class="p-0 card-body tab-pane fade" role="tabpanel">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-bordered gy-6">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 border-bottom fs-6 fw-bold bg-lighten">
                            <tr>
                                <th class="min-w-125px ps-9">Order ID</th>
                                <th class="px-0 min-w-125px">User</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Bonus</th>
                                <th class="min-w-125px ps-0">Profit</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="text-gray-600 fs-6 fw-semibold">
                            <tr>
                                <td class="ps-9">578433345</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Maria Garcia</a>
                                </td>
                                <td>Aug 10, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$2,400.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Robert Smith</a>
                                </td>
                                <td>May 06, 2020</td>
                                <td>18%</td>
                                <td class="text-success">$940.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">256899235</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Juan Carlos</a>
                                </td>
                                <td>Jan 02, 2020</td>
                                <td>35%</td>
                                <td class="text-success">$820.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">245899092</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Paul Johnson</a>
                                </td>
                                <td>Feb 29, 2020</td>
                                <td>21%</td>
                                <td class="text-success">$380.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">505432578</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Sarah Jones</a>
                                </td>
                                <td>Jan 08, 2020</td>
                                <td>47%</td>
                                <td class="text-success">$2,050.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">098669322</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Williams Brown</a>
                                </td>
                                <td>Apr 30, 2020</td>
                                <td>43%</td>
                                <td class="text-success">$200.00</td>
                            </tr>
                            <tr>
                                <td class="ps-9">678935899</td>
                                <td class="ps-0">
                                    <a href="" class="text-gray-600 text-hover-primary">Marcus Harris</a>
                                </td>
                                <td>Nov 24, 2020</td>
                                <td>26%</td>
                                <td class="text-success">$1,200.00</td>
                            </tr>
                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Tab panel-->
        </div>
        <!--end::Tab content-->
    </div>
</x-dashboard-layout>
