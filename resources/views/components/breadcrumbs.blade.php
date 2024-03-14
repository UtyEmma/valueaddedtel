<div id="kt_app_toolbar" class="mb-5 app-toolbar">
    <div id="kt_app_toolbar_container" class="flex-wrap app-container container-xxl d-flex flex-stack">
        <div class="gap-1 page-title d-flex flex-column justify-content-center me-3">
            <h1 class="m-0 text-gray-900 page-heading d-flex flex-column justify-content-center fw-bold fs-3">{{$title}}</h1>

            {{-- breadcrumb-separatorless --}}
            <ul class="my-0 breadcrumb fw-semibold fs-7">
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

        <div class="gap-2 d-flex align-items-center gap-lg-3">
            {{$slot}}
        </div>
    </div>
</div>
