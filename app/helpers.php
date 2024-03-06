<?php

if(!function_exists('status')) {
    function status(bool $status, $message = '', $data = []){
        return [$status, $message, $data];
    }
}
