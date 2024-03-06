<?php

namespace App\Library;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload {

    private $files;

    function __construct($files) {
        $files = is_array($files) ? $files : [$files];
        $this->files = collect($files);
    }

    private function paths($paths){
        if(count($paths) == 1) return $paths[0];
        return $paths;
    }

    function toCloud(){
        // $files = $this->files->map(function($file) {
        //     return cloudinary()->uploadFile($file->getRealPath())->getSecurePath();
        // });

        // return $this->paths($files);
    }

    function toPublic($folder = '', $name = null){
        $files = $this->files->map(function($file) use($folder, $name) {
            $ext = $file->getClientOriginalExtension();
            $imageName = ($name ? $name : time().'-'.Str::random()).'.'.$ext;
            $file->move(public_path($folder), $imageName);
            return asset($folder.'/'.$imageName);
        });

        return $this->paths($files);
    }

    function toStorage($folder = '', $name = null){
        $files = $this->files->map(function($file) use($folder, $name) {
            $ext = $file->getClientOriginalExtension();
            $imageName = ($name ? $name : time().'-'.Str::random()).'.'.$ext;
            return Storage::put($folder.'/'.$imageName, $file);
        });

        return $this->paths($files);
    }

}
