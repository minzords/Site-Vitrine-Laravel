<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use App\Models\Categorie as ModelsCategorie;

class produit extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | It list all product, categories and return the view 'welcome' with the
    | products and categories
    |
    */
    public function index(): View
    {
        $produits = Produits::all();
        $categories = $this->getCategories();
         
        return view('pages.welcome', compact('produits', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Get Produit
    |--------------------------------------------------------------------------
    |
    | It search the product with the id $id and return the name of the product
    |
    */
    public function getproduit($id) : Produits
    {
        $produit= Produits::findorfail($id);
        return $produit['nom'];
    }

    /*
    |--------------------------------------------------------------------------
    | Get Categories
    |--------------------------------------------------------------------------
    |
    | It list all of the categories and return the array of categories 
    |
    */
    public function getCategories(): Collection
    {
        $categories = ModelsCategorie::all()->pluck('nom');
        return $categories;
    }

    /*
    |--------------------------------------------------------------------------
    | List By Category
    |--------------------------------------------------------------------------
    |
    | It list search all posts in the category $name and return the view 
    | 'categorie' with the posts
    |
    */
    public function listByCategory($nom): View
    {
        $produits = Produits::whereHas('categories', function ($query) use ($nom) {
            $query->where('nom', $nom);
        })
        ->get();

        $categories = $this->getCategories();

        return view('pages.produit_par_categorie', compact('produits', 'categories'));
    }
}