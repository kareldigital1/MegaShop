<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer; // Assurez-vous que le modèle Customer existe

class CustomerController extends Controller
{
    public function index()
    {
        // Récupérez les clients depuis la base de données
        $customers = Customer::all();

        // Retournez la vue avec les données
        return view('admin.customers', compact('customers'));
    }
}
