<?php

namespace App\Library;

use Illuminate\Support\Str;

class Generator {

    function repeater($len, $val){
        $str = '';

        for ($i=0; $i < $len; $i++) {
            $str .= $val;
        }

        return $str;
    }

    function number($min = 0, $max = 9){
        return random_int($min, $max);
    }

    function str($len){
        return Str::random($len);
    }

}
