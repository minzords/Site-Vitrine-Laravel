<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produits;
use App\Models\Categorie;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
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
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,avif|max:4096'
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
    | Edit
    |--------------------------------------------------------------------------
    |
    | It return the view 'admin.produit.edit' (The form to edit a product)
    |
    */
    public function edit(int $id): View
    {
        $produit = Produits::findorfail($id);
        $categories = Categorie::all();


        return view('admin.produit.edit', compact('produit', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store Update Article
    |--------------------------------------------------------------------------
    |
    | It update the product with the data from the form and redirect to the
    | route 'product.list'
    |
    */
    public function store_article(Request $request) {
        $validatedData = $request->validate([
            'nom' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp,avif|max:4096'
        ]);

        $update = DB::table('produits') 
            ->where('id', $request->id)
            ->update([
                'nom' => $request->nom,
            ]);

        // TODO Not working yet, need to fix it
        $update_category = DB::table('categorie_produit')
            ->where('produits_id', $request->id)
            ->update([
                'categorie_id' => $request->category,
            ]);

        if ($request->hasFile('image')) {
            $name = Storage::put('public/produits', $request->file('image'));
            $name = str_replace('public/', 'storage/', $name);

            $update_picture = DB::table('produits')
                ->where('id', $request->id)
                ->update([
                    'photo' => $name,
                ]);
        }

        return (Redirect::route('product.list')->with('Succès', 'Le produit a bien été modifié'));
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
