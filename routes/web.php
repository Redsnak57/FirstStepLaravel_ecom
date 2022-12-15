<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Client 
Route::get("/", [ClientController::class, "home"]);
Route::get("/shop", [ClientController::class, "shop"]);
Route::get("/cart", [ClientController::class, "cart"]);
Route::get("/checkout", [ClientController::class, "checkout"]);
Route::get("/register", [ClientController::class, "register"]);
Route::get("/sigin", [ClientController::class, "sigin"]);

// Admin
Route::get("/admin", [AdminController::class, "admin"]);
Route::get("/admin/addCategory", [AdminController::class, "addCategory"]);
Route::get("/admin/categories", [AdminController::class, "categories"]);
Route::get("/admin/addSlider", [AdminController::class, "addSlider"]);
Route::get("/admin/sliders", [AdminController::class, "sliders"]);
Route::get("/admin/addProduct", [AdminController::class, "addProduct"]);
Route::get("/admin/products", [AdminController::class, "products"]);
Route::get("/admin/orders", [AdminController::class, "orders"]);

// Admin Category Controller
Route::post("/admin/saveCategory", [CategoryController::class, "saveCategory"]);
Route::delete("/admin/deleteCategory/{id}", [CategoryController::class, "deleteCategory"]);
Route::get("/admin/updateCategory/{id}", [CategoryController::class, "updateCategory"]);
Route::put("/admin/editCategory/{id}", [CategoryController::class, "editCategory"]);

// Admin Slider Controller
Route::post("/admin/saveslider", [SliderController::class, "saveSlider"]);
Route::delete("/admin/deleteslider/{id}", [SliderController::class, "deleteSlider"]);
Route::get("/admin/editslider/{id}", [SliderController::class, "editSlider"]);
Route::put("/admin/updateslider/{id}", [SliderController::class, "updateSlider"]);