<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('custom/js/imask.js')}}"></script>

<script src="{{asset('assets/js/notiflix.min.js')}}"></script>

@stack('scripts')

@stack('modals')
@stack('drawers')
<x-toast />
