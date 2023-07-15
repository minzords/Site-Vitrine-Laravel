<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie as ModelCategorie;
use Illuminate\Http\RedirectResponse;

class categorie extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | It list all of the categories and return the view 'admin.categories.list'
    |  with the categories
    |
    */
    public function index(): View
    {
        $categories = ModelCategorie::all();

        return view('admin.categories.list', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    |
    | It return the view 'admin.categories.create' (The form to create a 
    | category)
    |
    */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | It create a new category with the data from the form and redirect to the
    | route 'categories.list'
    |
    */
    public function store(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'nom' => 'required'
        ]);

        $categorie = ModelCategorie::create([
            'nom' => $validatedData['nom'],
        ]);

        return redirect()->route('categories.list')->with('Succès', 'La catégorie a bien été créée');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    |
    | It delete the category with the id $id and redirect to the route
    |
    */
    public function delete(int $id): RedirectResponse
    {
        $categorie = ModelCategorie::findorfail($id);
        $categorie->delete();

        return redirect()->route('categories.list')->with('Succès', 'La catégorie a bien été supprimée');
    }
}
