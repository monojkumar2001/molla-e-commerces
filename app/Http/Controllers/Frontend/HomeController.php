<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $data['meta_title'] = 'E-commerce';
        $data['meta_keywords'] = 'hello';
        $data['meta_description'] = 'word';
        $sliders = Slider::all();
        return view('frontend.home.Index', compact('sliders'), $data);
    }
    public function about()
    {
        return view('frontend.about.Index');
    }
}
