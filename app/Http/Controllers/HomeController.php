<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function home()
    {
        $categories = Category::all(); // Récupère toutes les catégories
        $featuredProducts = Product::where('is_featured', true)->take(8)->get(); // Récupère les produits vedettes
        return view('home.home', compact('categories', 'featuredProducts'));
    }

    public function about()
    {
        return view ('home.about');
    }
    public function products()
    {
        return view ('home.products');
    }
    public function categorie()
    {
        return view ('home.categorie');
    }
    public function dashboard()
    {
        // Calcul des ventes totales
        $totalSales = Order::sum('total_price');

        // Nombre total de commandes
        $totalOrders = Order::count();

        // Nombre total de clients
        $totalCustomers = User::where('role', 'client')->count();

        // Valeur moyenne du panier
        $averageCartValue = Order::avg('total_price');

        // Activités récentes (exemple : commandes récentes)
        $recentActivities = Order::latest()->take(5)->get()->map(function ($order) {
            return [
                'icon' => 'fa-shopping-cart',
                'text' => "Nouvelle commande #{$order->id}",
                'time' => $order->created_at->diffForHumans(),
                'bg' => 'bg-primary',
            ];
        });

        // Commandes récentes
        $recentOrders = Order::latest()->take(5)->get();

        // Produits populaires (basé sur les ventes dans la table `order_items`)
        $popularProducts = Product::withCount(['orderItems as sales_count' => function ($query) {
            $query->select(DB::raw('SUM(quantity)'));
        }])->orderBy('sales_count', 'desc')->take(5)->get();

        // Revenus mensuels (exemple basé sur les commandes par mois)
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyRevenueLabels = $monthlyRevenue->map(function ($data) {
            return \Carbon\Carbon::create()->month($data->month)->translatedFormat('M');
        });

        $monthlyRevenueData = $monthlyRevenue->pluck('revenue');

        // Commandes hebdomadaires (exemple basé sur les commandes par jour de la semaine)
        $weeklyOrders = Order::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as orders')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $weeklyOrdersLabels = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
        $weeklyOrdersData = $weeklyOrders->pluck('orders');

        // Ventes par catégorie
        $categorySales = Product::selectRaw('categories.name as category, SUM(order_items.quantity) as total_sales')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('categories.name')
            ->orderBy('total_sales', 'desc')
            ->get();

        $categoryLabels = $categorySales->pluck('category');
        $categoryData = $categorySales->pluck('total_sales');

        return view('home.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'averageCartValue',
            'recentActivities',
            'recentOrders',
            'popularProducts',
            'monthlyRevenueLabels',
            'monthlyRevenueData',
            'weeklyOrdersLabels',
            'weeklyOrdersData',
            'categoryLabels',
            'categoryData'
        ));
    }

    public function index()
    {
        $produits = Product::all(); // Assurez-vous que le modèle Produit existe
        return view('home.home', compact('produits'));
    }
}
