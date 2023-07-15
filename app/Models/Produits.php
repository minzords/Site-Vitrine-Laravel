<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produits extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'photo',
    ];

    // Get Categories associated with Produit
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_produit', 'produit_id', 'categorie_id');
    }
}
