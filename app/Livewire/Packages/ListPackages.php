<?php

namespace App\Livewire\Packages;

use App\Models\Packages\Package;
use App\Models\User;
use App\Services\PackageService;
use App\Traits\Livewire\WithToast;
use Livewire\Component;

class ListPackages extends Component {
    use WithToast;

    public User $user;
    public Package | null $selectedPackage = null;

    public function mount(){
        $this->user = authenticated();
    }

    function select(Package $package){
        if(!$package) return $this->toast("The selected package does not exist", 'Invalid Package')->error();
        $this->selectedPackage = $package;

        return $this->js("$('#select-package-modal').modal('show')");
    }

    function upgrade(){
        [$status, $message] = (new PackageService)->upgrade($this->user, $this->selectedPackage);
        if(!$status) return $this->toast($message, 'Upgrade Failed')->error();

        $this->toast($message, 'Package Upgrade Successful')->success();

        return $this->js("$('#select-package-modal').modal('hide')");
    }

    public function render() {
        $packages = Package::isActive()->whereIsDefault(false)->latest('fee')->get();

        return view('livewire.packages.list-packages', [
            'packages' => $packages
        ]);
    }
}
