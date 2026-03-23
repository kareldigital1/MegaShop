<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Affiche la liste des produits pour le tableau de bord.
     */
    public function index()
    {
        $products = Product::all(); // Récupère tous les produits
        $categories = Category::all(); // Récupère toutes les catégories
        return view('admin.products', compact('products', 'categories')); // Passe les données à la vue
    }

    /**
     * Supprime un produit.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Ajoute un nouveau produit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Modifie un produit.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Produit modifié avec succès.');
    }
}
