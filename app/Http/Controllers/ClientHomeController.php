<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function index()
    {
        return view('client.home');
    }   
}
