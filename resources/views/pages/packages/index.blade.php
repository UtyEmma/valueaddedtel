<x-dashboard-layout
    title="Packages"
    :breadcrumbs="[
        ['title' => 'Overview', 'href' => route('dashboard')],
        ['title' => 'Packages']
    ]"
>

    <livewire:packages.list-packages :packages="$packages" />

</x-dashboard-layout>
