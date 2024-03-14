@props([
    'header',
    'footer',
    'body',
    'id',
    'class',
])



<div class="modal fade" role="dialog" wire:ignore.self id="{{$id}}" {{$attributes->except(['class'])}}>
    <div class="modal-dialog modal-dialog-centered overflow-hidden {{$class ?? ''}}" role="document">
        <div class="modal-content">
            @isset($header)
                <div {{$header->attributes->class(['modal-header py-5'])}}>
                    {{$header}}

                    <button class="btn btn-icon btn-sm ms-2" type="button" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endisset


            @isset($body)
                <div {{$body->attributes->class(['text-start'])}}>
                    {{$body}}
                </div>
            @else
                <div class="modal-body text-start {{isset($nopadding) ? 'p-0' : ''}}">
                    {{$slot}}
                </div>
            @endisset


            @isset($footer)
                <div {{$footer->attributes->class(['modal-footer'])}}>
                    {{$footer}}
                </div>
            @endisset
        </div>
    </div>
</div>
