<?php

use App\Library\Response;
use App\Library\Toast;
use App\Library\Upload;
use App\Models\User;

if(!function_exists('status')) {
    function status($status, $message = '', $data = []){
        return [$status, $message, $data];
    }
}

if(!function_exists('authenticated')){
    function authenticated(){
        return User::find(auth()->id());
    }
}

if(!function_exists('respond')){
    function respond(){
        return new Response();
    }
}

if(!function_exists('upload')) {
    function upload($files){
        return new Upload($files);
    }
}

if(!function_exists('toast')) {
    function toast($message, $title = null){
        return new Toast($message, $title);
    }
}

