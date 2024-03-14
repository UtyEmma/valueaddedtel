<table {{$attributes->merge(['class' => 'table align-middle table-row-dashed fs-6 gy-5', 'id' => 'data-table'])}} >
    {{$slot}}
</table>

@push('scripts')
    <script>
        $(document).ready(function(){
            $("{{$id ?? '#data-table'}}").DataTable({
                info: !1,
                order: [],
                paging: @js(isset($paging)),
                @isset($options)
                    @js($options)
                @endisset
            });
        })
    </script>
@endpush

@pushOnce('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
@endPushOnce

@pushOnce('styles')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endPushOnce
