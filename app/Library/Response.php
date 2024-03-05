<?php

namespace App\Library;

class Response {

    private $code = 200;
    private $wantsJson = false;
    private $status = true;

    private function mapFunctionParameters(array $args) : array {
        $data = [];
        $message = '';

        foreach ($args as $arg) :
            if(is_string($arg)) $message = $arg;
            if(is_array($arg)) $data = array_merge($data, $arg);
        endforeach;

        $response = [
            'message' => $message,
            'success' => $this->status ? $message : '',
            'error' => $this->status ? '' : $message,
            ...$data
        ];
        
        return $response; 
    }

    static function success(int $code = 200){
        $self = new self;
        $self->code = $code;
        $self->status = true;
        $self->wantsJson = request()->expectsJson();
        return $self;    
    }

    static function error(int $code = 400){
        $self = new self;
        $self->code = $code;
        $self->status = false;
        $self->wantsJson = request()->expectsJson();
        return $self;    
    }

    function redirectBack(mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return $this->wantsJson ? $this->json($data) : back()->with($data);
    }

    function back(mixed ...$args){
        $data = $this->mapFunctionParameters($args);

        return $this->wantsJson ? $this->json($data) : back()->with($data);
    }
    
    function to_route(string $route, $param = [], mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return $this->wantsJson ? $this->json($data) : to_route($route, $param)->with($data);
    }

    function redirect(string $to, mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return $this->wantsJson ? $this->json($data) : redirect($to)->with($data);
    }
    
    function intended(string $default, mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return $this->wantsJson ? $this->json($data) : redirect()->intended($default)->with($data);
    }
    
    function view($blade, mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return $this->wantsJson ? $this->json($data) : response()->view($blade, $data);
    }
    
    function json(mixed ...$args){
        $data = $this->mapFunctionParameters($args);
        return response()->json($data, $this->code);
    }

}
