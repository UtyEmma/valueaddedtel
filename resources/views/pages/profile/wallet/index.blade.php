<x-dashboard-layout
    title="Wallet"
    :breadcrumbs="[
        ['title' => 'Overview', 'href' => route('dashboard')],
        ['title' => 'Wallet']
    ]"
>
    <livewire:pages.wallet />

</x-dashboard-layout>
