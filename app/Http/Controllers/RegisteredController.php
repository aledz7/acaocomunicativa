<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredController extends Controller
{
    //
    public function index()
    {
    	return view('admin.registereds');
    }
}
