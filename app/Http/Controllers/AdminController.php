<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        return view("admin.home");
    }

    public function addCategory(){
        return view("admin.addCategory");
    }

    public function categories(){
        $categories = Category::get();
        return view("admin.categories")->with("categories", $categories);
    }

    public function addSlider(){
        return view("admin.addSlider");
    }

    public function sliders(){
        $sliders = Slider::get();
        return view("admin.sliders")->with("sliders", $sliders);
    }

    public function addProduct(){
        $categories = Category::get();
        return view("admin.addProduct")->with("categories", $categories);
    }

    public function products(){
        $product = Product::get();
        return view("admin.products")->with("products", $product);
    }

    public function orders(){
        return view("admin.orders");
    }
}
