<?php

namespace App\Http\Controllers;

use App\images;
use App\products;
use App\Sections;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $sections = Sections::all();
        $images=images::all();
        $products=products::all();
        return view('home',compact('products','images','sections'));
    }
}
