<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function saveSlider(Request $request){
        $this->validate($request,[
            "description1" => "required",
            "description2" => "required",
            "image" => "required|image|nullable|max:1999",
        ], [
            "description1.required" => "La première description est obligatoire",
            // "description1.min" => "La première description doit contenir 10 caractères minimum",
            "description2.required" => "La deuxième description est obligatoire",
            // "description2.min" => "La deuxième description doit contenir 20 caractères minimum",
            "image.required" => "L'image est obligatoire",
        ]);
        // récuperer le vrai nom de l'image
        $fileNameWithExtension = $request->file("image")->getClientOriginalName();
        // récupère le nom
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        // récupère l'extension
        $fileExtension = $request->file("image")->getClientOriginalExtension();
        // nom unique
        $fileNameToStore = $fileName."_".time().".".$fileExtension;
        // upload image 
        $path = $request->file("image")->storeAs("public/sliderImage", $fileNameToStore);

        $slider = new Slider();
        $slider->description1 = $request->input("description1");
        $slider->description2 = $request->input("description2");
        $slider->image = $fileNameToStore;
        $slider->save();

        return back()->with("status", "Votre slider a bien été ajouté.");
    }
}
