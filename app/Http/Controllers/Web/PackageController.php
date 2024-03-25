<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Packages\Package;
use Illuminate\Http\Request;

class PackageController extends Controller {

    function index(){
        $packages = Package::isActive()->whereIsDefault(false)->latest('fee')->get();
        return view('pages.packages.index', compact('packages'));
    }

}
