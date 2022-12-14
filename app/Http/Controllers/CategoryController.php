<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function saveCategory(Request $request){
        $this->validate($request,[
            "category_name" => "required|min:5",
        ],[
            "category_name.required" => "Le nom de la catégorie est obligatoire",
            "category_name.min" => "La catégorie doit faire 5 caractères minimum",
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return back()->with("status", "Votre categorie a bien été ajoutée.");
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return back()->with("status", "Votre categorie a bien été supprimée.");
    }

    public function updateCategory($id){
        $category = Category::find($id);
        return view("admin.updateCategory")->with("category", $category);
    }

    public function editCategory($id, Request $request){
        $category = Category::find($id);
        $category->category_name = $request->input("category_name");
        $category->update();

        return redirect("admin/categories")->with("status", "Votre categorie a bien été modifiée.");
    }
}
