<?php

namespace App\Traits\Livewire;

use App\Library\Toast;

trait WithToast {

    function toast($message, $title = null, $status = null){
        $toast = new Toast($message, $title, $status);
        $toast->livewire = $this;
        return $toast;
    }

}
