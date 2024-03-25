<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
        <div class="py-5 aside-search">

        </div>
    </div>

    <div class="aside-menu flex-column-fluid">
        <div class="mx-3 my-5 hover-scroll-overlay-y my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">

                <div class="pt-3 menu-item">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Main</span>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{request()->routeIs('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}" target="_blank">
                        <span class="menu-icon">
                            <i class="ki-outline ki-home fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Overview</span>
                    </a>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion show">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-phone fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Buy Airtime</span>
                        <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{request()->routeIs('services.airtime') ? 'active' : ''}}" href="{{route('services.airtime')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Airtime Topup</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Recharge Card Pins</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">International Airtime</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-wifi-square fs-2"></i>
                        </span>
                        <span class="menu-title">Data Purchase</span>
                        <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">SME / CG Data</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Internet Data</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Data Card</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Smile Data</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Spectranet</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-screen fs-2">
                            </i>
                        </span>
                        <span class="menu-title">TV Subscriptions</span>
                        <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">DSTV Subscription</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">GoTv Subscription</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Startimes Subscription</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="index.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Showmax Subscription</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-flash-circle fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Electricity Bills</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-teacher fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Education</span>
                    </a>
                </div>

                <div class="pt-3 menu-item">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Account</span>
                    </div>
                </div>

                <div class="menu-item">
                    <a href="{{route('profile.wallet')}}" class="menu-link {{request()->routeIs('profile.wallet') ? 'active' : ''}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-wallet fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Wallet</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{route('profile.index')}}" class="menu-link {{request()->routeIs('profile.index') ? 'active' : ''}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-profile-user fs-2">
                            </i>
                        </span>
                        <span class="menu-title">My Account</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{route('profile.referrals')}}" class="menu-link {{request()->routeIs('profile.referrals') ? 'active' : ''}}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-data fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Organization</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-message-question fs-2">
                            </i>
                        </span>
                        <span class="menu-title">Support</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="py-5 aside-footer flex-column-auto" id="kt_aside_footer">
        <a href="{{route('packages')}}" class="btn btn-flex btn-custom btn-primary w-100" >
            <span class="btn-label">Upgrade Package</span></a>
    </div>
</div>
