<?php

namespace App\Library;

class Token {

    private Generator $generator;

    function __construct(){
        $this->generator = new Generator;
    }

    function numeric($model, $column = 'code', $len = 6){
        $code = rand($this->generator->repeater($len, 0), $this->generator->repeater($len, 9));
        if($model::where($column, $code)->exists()) return $this->numeric($model, $column, $len);
        return $code;
    }

}
