<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class home extends Controller
{
    //

    public function store(){
        echo "hello";
    }
    public function show($id)
    {
        // return view('user.profile', ['user' =>::findOrFail($id)]);
    }
}
