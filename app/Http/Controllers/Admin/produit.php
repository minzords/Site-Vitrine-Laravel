<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produits;
use App\Models\Categorie;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class produit extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | It list all of the products and return the view 'admin.produits.list'
    |
    */
    public function index(): View
    {
        $produits = Produits::all();

        return view('admin.produit.list', compact('produits'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    |
    | It return the view 'admin.produit.create' (The form to create a product)
    |
    */
    public function create(): View
    {
        $categories = Categorie::all();
        return view('admin.produit.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | It upload the image and create a new product with the data from the form
    | and redirect to the route 'product.list'
    |
    */
    public function store(Request $request): RedirectResponse
    {

        // Validation du formulaire
        $validatedData = $request->validate([
            'nom' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        // Upload de l'image    
        $name = Storage::put('public/produits', $request->file('image'));
        $name = str_replace('public/', 'storage/', $name);

        $produits = Produits::create([
            'nom' => request('nom'),
            'category_id' => (request('category')),
            'photo' => $name,
        ]);

        // Pivot Table
        $produits = Produits::find(Produits::latest()->first()->id);
        $produits->categories()->attach(request('category'));

        return redirect()->route('product.list')->with('Succès', 'Le produit a bien été créée');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    |
    | It delete the product with the id $id and redirect to the route
    | 'product.list'
    |
    */
    public function delete(int $id): RedirectResponse
    {
        $produits = Produits::findorfail($id);
        $fileName = str_replace('storage/', 'public/', $produits->photo);

        if (Storage::disk()->exists($fileName)) {
            Storage::disk()->delete($fileName);
        }
        
        $produits->categories()->detach();
        $produits->delete();        

        return redirect()->route('product.list')->with('Succès', 'Le produit a bien été supprimée');
    }
}