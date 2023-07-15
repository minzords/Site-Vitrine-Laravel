<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produit;
use App\Http\Controllers\Admin\produit as AdminProduit;
use App\Http\Controllers\Admin\categorie as AdminCategorie;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [produit::class, 'index'])->name('welcome');
Route::get('/categorie/{nom}', [produit::class, 'listByCategory'])->name('product.category');


Route::get('/admin', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Apps routes
    Route::get('/categories', [produit::class, 'listCategories'])->name('categories');
    Route::get('/products', [produit::class, 'listProducts'])->name('products');

    // Admin routes
    // Products
    Route::get('/admin/products', [AdminProduit::class, 'index'])->name('product.list');
    Route::get('/admin/products/create', [AdminProduit::class, 'create'])->name('product.create');
    Route::post('/admin/products/store', [AdminProduit::class, 'store'])->name('product.store');
    Route::get('/admin/products/{id}/edit', [AdminProduit::class, 'edit'])->name('product.edit');
    Route::get('/admin/products/{id}/delete', [AdminProduit::class, 'delete'])->name('product.delete');
    // Categories
    Route::get('/admin/categories', [AdminCategorie::class, 'index'])->name('categories.list');
    Route::get('/admin/categories/create', [AdminCategorie::class, 'create'])->name('categories.create');
    Route::post('/admin/categories/store', [AdminCategorie::class, 'store'])->name('categories.store');
    Route::get('/admin/categories/{id}/edit', [AdminCategorie::class, 'edit'])->name('categories.edit');
    Route::get('/admin/categories/{id}/delete', [AdminCategorie::class, 'delete'])->name('categories.delete');
});

require __DIR__.'/auth.php';

# routes/web.php
