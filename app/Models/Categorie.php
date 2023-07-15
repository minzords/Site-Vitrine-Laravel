<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['nom'];

    /**
     * Get the products for the categorie.
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'categorie_produit', 'categorie_id', 'produit_id');
    }   
}
