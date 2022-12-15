<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function home(){
        $sliders = Slider::where("status",1)->get();
        $products = Product::where("status",1)->get();
        return view("client.home")->with("sliders", $sliders)->with("products", $products);
    }

    public function shop(){
        $products = Product::where("status",1)->get();
        return view("client.shop")->with("products", $products);
    }

    public function cart(){
        return view("client.cart");
    }

    public function checkout(){
        if(Session::has("client")) return view("client.checkout");
        return redirect("/sigin");
    }

    public function register(){
        return view("client.register");
    }

    public function createAccount(Request $request){
        $this->validate($request,[
            "email" => "required|email|unique:clients",
            "password" => "required|min:3",
        ], [
            "email.required" => "Email obligatoire",
            "email.email" => "Email inccorect",
            "email.unique" => "L'email existe déjà",
            "password.required" => "Mot de passe obligatoire",
            "password.min" => "Le mot de passe doit contenir 3 caractères minimum",
        ]);

        $client = new Client();
        $client->email = $request->input("email");
        $client->password = bcrypt($request->input("password"));
        $client->save();

        return back()->with("status", "Compte crée avec succes.");
    }

    public function accesAccount(Request $request){
        $this->validate($request,[
            "email" => "required|email",
            "password" => "required",
        ], [
            "email.required" => "Email obligatoire",
            "password.required" => "Mot de passe obligatoire",
        ]);

        $client = Client::where("email", $request->email)->first();
        if($client){
            if(Hash::check($request->input("password"), $client->password)){
                Session::put("client", $client);
                return redirect("/shop");
            } else {
                return back()->with("error", "Email ou mot de passe incorrect");
            }
        }
        return back()->with("error", "Email ou mot de passe incorrect");
    }

    public function sigin(){
        return view("client.sigin");
    }

    public function logout(){
        Session::forget("client");
        return back();
    }

    public function addToCart($id){
        $product = Product::find($id);
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->add($product);
        Session::put("cart", $cart);
        Session::put("topCart", $cart->items);

        return back();
    }

    public function updateQty(Request $request, int $id){
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->input("qty"));
        Session::put("cart", $cart);
        Session::put("topCart", $cart->items);

        return back();
    }

    public function removeItem($id){
        $oldCart = Session::get("cart");
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put("cart", $cart);
        Session::put("topCart", $cart->items);

        return back();
    }
}
