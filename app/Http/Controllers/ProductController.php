<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     /**
     * Affiche la liste des produits.
     */
    public function index()
    {
        $produits = Product::all(); // Récupère tous les produits
        $categories = Category::all(); // Récupère toutes les catégories
        return view('products.index', compact('produits', 'categories')); // Passe les données à la vue
    }

    /**
     * Affiche le formulaire de création d'un produit.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Enregistre un nouveau produit.
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

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    /**
     * Affiche un produit spécifique.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Affiche le formulaire d'édition d'un produit.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Met à jour un produit existant.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprime un produit.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
