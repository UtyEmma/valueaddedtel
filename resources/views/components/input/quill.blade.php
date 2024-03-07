@props([
    'height' => '200px',
    'name' => '',
    'toolbar' => [
        ['bold', 'italic', 'underline'], 
        [['list' => 'ordered'], ['list' => 'bullet']],
        ['link', ],       
    ],
    'placeholder' => 'Compose an epic...',
    'value' => ''
])

<style>
    .ql-toolbar{
        background: white;
        border-radius: 0.65rem !important;
        background: var(--bs-gray-100);
        margin: 5px auto;
    }

    .ql-container {
        border-radius: 5px;
    }

    .ql-editor{
        padding: 0px;
    }
</style>

<div wire:ignore x-data="{
    quill: null,
}" x-key="{{$id ?? Str::random()}}" class="">
    <div
        x-ref="quillEditor"
        x-init="
            quill = new Quill($refs.quillEditor, {
                theme: 'snow',
                modules: {
                    toolbar: @js($toolbar)
                },
                placeholder: '{{$placeholder}}'
            });

            quill.root.insertAdjacentHTML('afterbegin', `{!! $value !!}`);

            quill.on('text-change', () => {
                $dispatch('input', quill.root.textContent ? quill.root.innerHTML : '');
                $refs.textArea.value = quill.root.textContent ? quill.root.innerHTML : '';
            });
        "
        style="height: {{$height}}"
        {{ $attributes->whereStartsWith('wire:model') }}
        {{$attributes->class('border form-control form-control-solid')}}
    ></div>
    <textarea type="text" x-ref="textArea" {{$attributes}} hidden name="{{$name}}"></textarea>
</div>
