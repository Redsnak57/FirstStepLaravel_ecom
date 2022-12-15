<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home(){
        $sliders = Slider::get();
        $products = Product::get();
        return view("client.home")->with("sliders", $sliders)->with("products", $products);
    }

    public function shop(){
        return view("client.shop");
    }

    public function cart(){
        return view("client.cart");
    }

    public function checkout(){
        return view("client.checkout");
    }

    public function register(){
        return view("client.register");
    }

    public function sigin(){
        return view("client.sigin");
    }
}
