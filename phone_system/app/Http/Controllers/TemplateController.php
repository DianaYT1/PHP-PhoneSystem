<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TemplateController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function view()
    {

        $data = product::all();
        return view('frontend.home',compact('data'));
    }
}
