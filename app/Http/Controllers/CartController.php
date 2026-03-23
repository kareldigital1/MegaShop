<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cartItems = CartItem::with('product') // Charge les produits associés
            ->where('user_id', Auth::id()) // Filtre par utilisateur connecté
            ->get();

        return view('home.cart', compact('cartItems')); // Passe $cartItems à la vue
    }

    // Ajouter un produit au panier
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        CartItem::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['quantity' => DB::raw('quantity + ' . $request->quantity)]
        );

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    // Supprimer un produit du panier
    public function remove($id)
    {
        $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }
}
