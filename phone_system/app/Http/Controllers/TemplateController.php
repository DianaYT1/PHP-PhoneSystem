<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TemplateController extends Controller
{
    public function index()
    {
        $phones = Product::orderBy('name')->get();
        return view('frontend.home' , compact('phones'));
    }

    public function view()
    {

        $phones = Product::all();
        return view('frontend.home',compact('phones'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        $phones = Product::where('name', 'like', "%$searchTerm%")
            ->orWhere('name', 'like', "%$searchTerm%")
            ->orderBy('name')
            ->get();

        return view('frontend.live-search-results', compact('phones'));
    }
}
