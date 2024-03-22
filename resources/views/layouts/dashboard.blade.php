<x-app-layout id="kt_body" class="aside-enabled" title="{{$title}}">
    <div class="d-flex flex-column flex-root">

        <div class="flex-row page d-flex flex-column-fluid">
            @include('layouts.partials.dashboard.sidebar')

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layouts.partials.dashboard.header')

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            {{$slot}}
                        </div>
                    </div>
                </div>

                @include('layouts.partials.dashboard.footer')
            </div>
        </div>
    </div>
</x-app-layout>
