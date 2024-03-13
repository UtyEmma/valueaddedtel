<div x-data="{type: @js($type ?? 'password')}" >
    <x-input.group {{$attributes->except('type')}} showPadding x-bind:type="type">
        <x-slot:right>
            <span role="button" class="lh-0 w-100 h-100" x-on:click="type = (type == 'password') ? 'text' : 'password'" >
                <template x-if="type == 'password'">
                    <i class="ki-outline ki-eye fs-2"></i>
                </template>

                <template x-if="type == 'text'">
                    <i class="ki-outline ki-eye-slash fs-2"></i>
                </template>
            </span>
        </x-slot:right>
    </x-input.group>
</div>
