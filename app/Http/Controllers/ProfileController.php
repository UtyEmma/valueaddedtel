<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller {

    function index() {
        return view('pages.profile.index');
    }

    function wallet() {
        return view('pages.profile.wallet');
    }

    function referrals(){
        return view('pages.profile.referrals');
    }

    function edit(){
        return view('pages.profile.edit');
    }

}
