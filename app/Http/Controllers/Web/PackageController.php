<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Packages\Package;
use Illuminate\Http\Request;

class PackageController extends Controller {

    function index(){
        return view('pages.packages.index');
    }

}
