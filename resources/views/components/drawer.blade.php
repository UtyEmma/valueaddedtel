<div  wire:ignore {{$attributes->merge([
    'class' => 'bg-body',
    'data-kt-drawer' => 'true',
    'data-kt-drawer-name' => 'chat',
    'data-kt-drawer-activate' => 'true',
    'data-kt-drawer-width' => "{default:'100%', 'md': '500px'}",
    'data-kt-drawer-overlay' => "true",
    'data-kt-drawer-direction' => 'end',
    'data-kt-drawer-toggle' => $id,
    'data-kt-drawer-close' => '#kt_drawer_chat_close' 
])}} >
    {{$slot}}
</div>
