<?php

namespace App\Livewire\Packages;

use App\Models\Packages\Package;
use App\Traits\Livewire\WithToast;
use Livewire\Component;

class ListPackages extends Component {
    use WithToast;

    public $packages = [];

    public Package | null $selectedPackage = null;

    function select(Package $package){
        if(!$package) return $this->toast("The selected package does not exist", 'Invalid Package')->error();
        $this->selectedPackage = $package;
        // dd($package);
        return $this->js("$('#select-package-modal').modal('show')");

    }

    public function render() {
        return view('livewire.packages.list-packages');
    }
}
