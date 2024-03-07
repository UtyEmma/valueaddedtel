@props([
    'state' => 'danger',
    'title' => 'Are you sure?',
    'caption' => 'This action cannot be reversed.',
    'cancel' => 'No, Cancel',
    'confirm' => 'Yes Proceed',
    'role' => 'link',
    'type' => 'button',
    'id' => 'bs-confirm-modal',
    'href' => '',
])

<a href="#" data-bs-toggle='modal' {{$attributes->only('class')}} data-bs-target='#{{$id}}'>
    {{$slot}}
</a>

@push('modals')
<div class="modal fade" id="{{$id}}" tabindex="-1" >
    <div class="modal-dialog text-start w-md-450px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center gap-5 mb-5">
                    <div>
                        <i class="ki-duotone text-{{ $state }} ki-information fs-md-4x fs-7x ">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div>
                        <h3 class="mb-0 font-bold" >{{$title}}</h3>
                        <p class="mb-0 fs-5 text-muted" >{{$caption}}</p>
                    </div>
                </div>

                <div class="text-end">
                    <div class="d-flex justify-content-end gap-5">
                        <button type="button" data-bs-dismiss='modal' class="btn btn-light">{{$cancel}}</button>

                        @if ($role == 'link')
                            <a href="{{$href}}" class='btn btn-{{$state}}'>{{$confirm}}</a>
                        @endif

                        @if ($role == 'button')
                            <x-button type="{{$type}}" {{ $attributes->whereStartsWith('wire:click') }} {{ $attributes->whereStartsWith('wire:loading') }} {{ $attributes->whereStartsWith('wire:target') }} class="btn btn-{{$state}}">{{$confirm}}</x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
