<div id="kt_header" class="header align-items-stretch">
    <div class="header-brand">
        <a href="{{route('dashboard')}}">
            <img alt="Logo" src="{{asset('assets/media/logos/default-dark.svg')}}" class="h-25px h-lg-25px" />
        </a>

        <div id="kt_aside_toggle" class="w-auto px-0 btn btn-icon btn-active-color-primary aside-minimize" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <i class="ki-duotone ki-entrance-right fs-1 me-n1 minimize-default">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <i class="ki-duotone ki-entrance-left fs-1 minimize-active">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>

        <div class="d-flex align-items-center d-lg-none me-n2" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--end::Brand-->
    <!--begin::Toolbar-->
    <div class="toolbar container-xxl justify-content-between d-flex align-items-stretch">
        <div class="py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
           <div class="page-title d-flex justify-content-center flex-column me-5">
            <h1 class="mb-0 text-gray-900 d-flex flex-column fw-bold fs-3">{{$title}}</h1>

            <ul class="pt-1 breadcrumb breadcrumb-line fw-semibold fs-7">
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item text-muted">
                        @isset($breadcrumb['href'])
                            <a href="{{$breadcrumb['href']}}" class="text-muted text-hover-primary">{{$breadcrumb['title']}}</a>
                        @else
                            {{$breadcrumb['title']}}
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        </div>

        {{-- <div class="app-navbar d-flex align-items-center" id="kt_app_header_navbar">
            <div class="app-navbar-item ms-1 ms-md-3">
                <!--begin::Menu- wrapper-->
                <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <i class="ki-outline ki-calendar fs-1"></i>
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
                    <!--begin::Heading-->
                    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
                        <!--begin::Title-->
                        <h3 class="mt-10 mb-6 text-white fw-semibold px-9">Notifications
                        <span class="opacity-75 fs-8 ps-3">24 reports</span></h3>
                        <!--end::Title-->
                        <!--begin::Tabs-->
                        <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                            <li class="nav-item">
                                <a class="pb-4 text-white opacity-75 nav-link opacity-state-100" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Alerts</a>
                            </li>
                            <li class="nav-item">
                                <a class="pb-4 text-white opacity-75 nav-link opacity-state-100 active" data-bs-toggle="tab" href="#kt_topbar_notifications_2">Updates</a>
                            </li>
                            <li class="nav-item">
                                <a class="pb-4 text-white opacity-75 nav-link opacity-state-100" data-bs-toggle="tab" href="#kt_topbar_notifications_3">Logs</a>
                            </li>
                        </ul>
                        <!--end::Tabs-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab panel-->
                        <div class="tab-pane fade" id="kt_topbar_notifications_1" role="tabpanel">
                            <!--begin::Items-->
                            <div class="px-8 my-5 scroll-y mh-325px">
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-outline ki-abstract-28 fs-2 text-primary"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Project Alice</a>
                                            <div class="text-gray-500 fs-7">Phase 1 development</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">1 hr</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="ki-outline ki-information fs-2 text-danger"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">HR Confidential</a>
                                            <div class="text-gray-500 fs-7">Confidential staff documents</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">2 hrs</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="ki-outline ki-briefcase fs-2 text-warning"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Company HR</a>
                                            <div class="text-gray-500 fs-7">Corporeate staff profiles</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">5 hrs</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-success">
                                                <i class="ki-outline ki-abstract-12 fs-2 text-success"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Project Redux</a>
                                            <div class="text-gray-500 fs-7">New frontend admin theme</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">2 days</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-outline ki-colors-square fs-2 text-primary"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Project Breafing</a>
                                            <div class="text-gray-500 fs-7">Product launch status update</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">21 Jan</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-info">
                                                <i class="ki-outline ki-picture fs-2 text-info"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Banner Assets</a>
                                            <div class="text-gray-500 fs-7">Collection of banner images</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">21 Jan</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <span class="symbol-label bg-light-warning">
                                                <i class="ki-outline ki-color-swatch fs-2 text-warning"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="mb-0 me-2">
                                            <a href="#" class="text-gray-800 fs-6 text-hover-primary fw-bold">Icon Assets</a>
                                            <div class="text-gray-500 fs-7">Collection of SVG icons</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">20 March</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                            <!--begin::View more-->
                            <div class="py-3 text-center border-top">
                                <a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
                                <i class="ki-outline ki-arrow-right fs-5"></i></a>
                            </div>
                            <!--end::View more-->
                        </div>
                        <!--end::Tab panel-->
                        <!--begin::Tab panel-->
                        <div class="tab-pane fade show active" id="kt_topbar_notifications_2" role="tabpanel">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column px-9">
                                <!--begin::Section-->
                                <div class="pt-10 pb-0">
                                    <!--begin::Title-->
                                    <h3 class="text-center text-gray-900 fw-bold">Get Pro Access</h3>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="pt-1 text-center text-gray-600 fw-semibold">Outlines keep you honest. They stoping you from amazing poorly about drive</div>
                                    <!--end::Text-->
                                    <!--begin::Action-->
                                    <div class="mt-5 text-center mb-9">
                                        <a href="#" class="px-6 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Illustration-->
                                <div class="px-4 text-center">
                                    <img class="mw-100 mh-200px" alt="image" src="assets/media/illustrations/sketchy-1/1.png" />
                                </div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Tab panel-->
                        <!--begin::Tab panel-->
                        <div class="tab-pane fade" id="kt_topbar_notifications_3" role="tabpanel">
                            <!--begin::Items-->
                            <div class="px-8 my-5 scroll-y mh-325px">
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">New order</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Just now</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-danger me-4">500 ERR</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">New customer</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">2 hrs</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Payment process</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">5 hrs</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-warning me-4">300 WRN</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Search query</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">2 days</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">API connection</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">1 week</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Database restore</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Mar 5</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-warning me-4">300 WRN</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">System update</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">May 15</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-warning me-4">300 WRN</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Server OS update</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Apr 3</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-warning me-4">300 WRN</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">API rollback</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Jun 30</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-danger me-4">500 ERR</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Refund process</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Jul 10</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-danger me-4">500 ERR</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Withdrawal process</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Sep 10</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="py-4 d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Code-->
                                        <span class="w-70px badge badge-light-danger me-4">500 ERR</span>
                                        <!--end::Code-->
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fw-semibold">Mail tasks</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light fs-8">Dec 10</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                            <!--begin::View more-->
                            <div class="py-3 text-center border-top">
                                <a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
                                <i class="ki-outline ki-arrow-right fs-5"></i></a>
                            </div>
                            <!--end::View more-->
                        </div>
                        <!--end::Tab panel-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>

            <div class="app-navbar-item ms-1 ms-md-3">
                <!--begin::Menu- wrapper-->
                <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <i class="ki-outline ki-abstract-26 fs-1"></i>
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                    <!--begin::Heading-->
                    <div class="py-10 d-flex flex-column flex-center bgi-no-repeat rounded-top px-9" style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
                        <!--begin::Title-->
                        <h3 class="mb-3 text-white fw-semibold">Quick Links</h3>
                        <!--end::Title-->
                        <!--begin::Status-->
                        <span class="px-3 py-2 badge bg-primary text-inverse-primary">25 pending tasks</span>
                        <!--end::Status-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Nav-->
                    <div class="row g-0">
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="apps/projects/budget.html" class="p-6 d-flex flex-column flex-center h-100 bg-hover-light border-end border-bottom">
                                <i class="mb-2 ki-outline ki-dollar fs-3x text-primary"></i>
                                <span class="mb-0 text-gray-800 fs-5 fw-semibold">Accounting</span>
                                <span class="text-gray-500 fs-7">eCommerce</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="apps/projects/settings.html" class="p-6 d-flex flex-column flex-center h-100 bg-hover-light border-bottom">
                                <i class="mb-2 ki-outline ki-sms fs-3x text-primary"></i>
                                <span class="mb-0 text-gray-800 fs-5 fw-semibold">Administration</span>
                                <span class="text-gray-500 fs-7">Console</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="apps/projects/list.html" class="p-6 d-flex flex-column flex-center h-100 bg-hover-light border-end">
                                <i class="mb-2 ki-outline ki-abstract-41 fs-3x text-primary"></i>
                                <span class="mb-0 text-gray-800 fs-5 fw-semibold">Projects</span>
                                <span class="text-gray-500 fs-7">Pending Tasks</span>
                            </a>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="col-6">
                            <a href="apps/projects/users.html" class="p-6 d-flex flex-column flex-center h-100 bg-hover-light">
                                <i class="mb-2 ki-outline ki-briefcase fs-3x text-primary"></i>
                                <span class="mb-0 text-gray-800 fs-5 fw-semibold">Customers</span>
                                <span class="text-gray-500 fs-7">Latest cases</span>
                            </a>
                        </div>
                        <!--end:Item-->
                    </div>
                    <!--end:Nav-->
                    <!--begin::View more-->
                    <div class="py-2 text-center border-top">
                        <a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
                        <i class="ki-outline ki-arrow-right fs-5"></i></a>
                    </div>
                    <!--end::View more-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>

            <div class="app-navbar-item ms-1 ms-md-3">
                <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative" id="kt_drawer_chat_toggle">
                    <i class="ki-outline ki-notification-on fs-1"></i>
                    <span class="top-0 mt-3 position-absolute start-100 translate-middle badge badge-circle badge-danger w-15px h-15px ms-n4">5</span>
                </div>
            </div>

            <div class="app-navbar-item ps-2">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <img src="assets/media/avatars/300-3.jpg" class="rounded-3" alt="user" />
                </div>
                <!--begin::User account menu-->
                <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="px-3 menu-item">
                        <div class="px-3 menu-content d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="assets/media/avatars/300-3.jpg" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">Robert Fox
                                <span class="px-2 py-1 badge badge-light-success fw-bold fs-8 ms-2">Pro</span></div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">robert@kt.com</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="my-2 separator"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="px-5 menu-item">
                        <a href="account/overview.html" class="px-5 menu-link">My Profile</a>
                    </div>
                    <div class="my-2 separator"></div>
                    <div class="px-5 menu-item" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                        <a href="#" class="px-5 menu-link">
                            <span class="menu-title position-relative">Mode
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                            </span></span>
                        </a>
                        <!--begin::Menu-->
                        <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                            <!--begin::Menu item-->
                            <div class="px-3 my-0 menu-item">
                                <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode" data-kt-value="light">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-night-day fs-2"></i>
                                    </span>
                                    <span class="menu-title">Light</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="px-3 my-0 menu-item">
                                <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode" data-kt-value="dark">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-moon fs-2"></i>
                                    </span>
                                    <span class="menu-title">Dark</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="px-3 my-0 menu-item">
                                <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode" data-kt-value="system">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-screen fs-2"></i>
                                    </span>
                                    <span class="menu-title">System</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>

                    <div class="px-5 my-1 menu-item">
                        <a href="account/settings.html" class="px-5 menu-link">Account Settings</a>
                    </div>

                    <div class="px-5 menu-item">
                        <a href="authentication/layouts/corporate/sign-in.html" class="px-5 menu-link">Sign Out</a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
