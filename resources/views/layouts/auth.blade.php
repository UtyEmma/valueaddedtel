<x-app-layout id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <div class="d-flex flex-column flex-root justify-content-center">
        <style>body { background-image: url({{asset('assets/media/auth/bg10.jpeg')}}); } [data-bs-theme="dark"] body { background-image: url({{asset('assets/media/auth/bg10-dark.jpeg')}}); }</style>

        <div class="container">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                    @isset($side)
                        <div class="d-flex flex-lg-row-fluid">
                            {{$side}}
                        </div>
                    @endisset

                    <div class="p-md-12 d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end {{isset($side) ? '' : 'w-100'}}">
                        <div class="p-10 mx-auto bg-body d-flex flex-column flex-center rounded-4 w-md-600px">
                            <div class="py-10 d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">

                                {{$slot}}

                                {{-- <div class="d-flex flex-stack">
                                    <div class="gap-5 d-flex fw-semibold text-primary fs-base">
                                        <a href="pages/team.html" target="_blank">Terms</a>
                                        <a href="pages/pricing/column.html" target="_blank">Plans</a>
                                        <a href="pages/contact.html" target="_blank">Contact Us</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
