<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class HomeController extends Controller
{
    public function getSlider()
    {
        $sliders = Slider::all();
        return view('frontend.pages.Index', compact('sliders'));
    }
}
