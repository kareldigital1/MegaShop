<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Si le nom de la table est différent de "customers", spécifiez-le ici
    protected $table = 'customers';

    // Ajoutez les colonnes autorisées pour l'insertion en masse
    protected $fillable = ['name', 'email', 'join_date', 'total_orders', 'total_spent', 'status'];
}
