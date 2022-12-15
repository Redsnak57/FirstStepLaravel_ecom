<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function saveProduct(Request $request){
        $this->validate($request,[
            "product_name" => "required",
            "product_price" => "required",
            "product_category" => "required",
            "product_image" => "required|image|nullable|max:1999",
        ]);
        // récuperer le vrai nom de l'image
        $fileNameWithExtension = $request->file("product_image")->getClientOriginalName();
        // récupère le nom
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        // récupère l'extension
        $fileExtension = $request->file("product_image")->getClientOriginalExtension();
        // nom unique
        $fileNameToStore = $fileName."_".time().".".$fileExtension;
        // upload product_image 
        $path = $request->file("product_image")->storeAs("public/productImage", $fileNameToStore);

        $product = new Product();
        $product->product_name	 = $request->input("product_name");
        $product->product_price = $request->input("product_price");
        $product->product_category = $request->input("product_category");
        $product->product_image = $fileNameToStore;
        $product->save();

        return back()->with("status", "Votre Produit a bien été ajouté.");
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        Storage::delete("public/productImage/$product->product_image");
        $product->delete();

        return back()->with("status", "Votre Produit a bien été supprimé.");
    }

    public function editProduct($id){
        $product = Product::find($id);
        $categories = Category::where("category_name", "!=", $product->product_category)->get();
        return view("admin.editProduct")->with("product", $product)->with("categories", $categories);
    }

    public function updateProduct(Request $request, int $id){
        $product = Product::find($id);
        $product->product_name = $request->input("product_name");
        $product->product_price = $request->input("product_price");
        $product->product_category = $request->input("product_category");

        if($request->file("product_image")){
            $fileNameWithExtension = $request->file("product_image")->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $fileExtension = $request->file("product_image")->getClientOriginalExtension();
            $fileNameToStore = $fileName."_".time().".".$fileExtension;
            
            Storage::delete("public/productImage/$product->image");
            $path = $request->file("product_image")->storeAs("public/productImage", $fileNameToStore);

            $product->product_image = $fileNameToStore;
        }
        $product->update();
        return redirect("admin/products")->with("status", "Votre produits a été modifié.");
    }

    public function unactivate($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->update();

        return redirect("admin/products")->with("status", "Votre produits a été modifié.");
    }

    public function activate($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->update();

        return redirect("admin/products")->with("status", "Votre produits a été modifié.");
    }
}
