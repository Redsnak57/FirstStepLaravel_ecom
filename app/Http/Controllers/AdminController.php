<?php

namespace App\Http\Controllers;

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
        return view("admin.sliders");
    }

    public function addProduct(){
        return view("admin.addProduct");
    }

    public function products(){
        return view("admin.products");
    }

    public function orders(){
        return view("admin.orders");
    }
}