<?php
namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Récupérer toutes les transactions avec les relations nécessaires
        $transactions = Transaction::with('customer')->get();

        // Retourner la vue avec les données
        return view('admin.transactions', compact('transactions'));
    }
}