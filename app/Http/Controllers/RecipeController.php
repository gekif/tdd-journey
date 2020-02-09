<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function create(Request $request)
    {
        //Validate
        $this->validate($request,['title' => 'required','procedure' => 'required|min:8']);

        //Create recipe and attach to user
        $user = Auth::user();
        $recipe = Recipe::create($request->only(['title','procedure']));
        $user->recipes()->save($recipe);

        //Return json of recipe
        return $recipe->toJson();
    }
}
