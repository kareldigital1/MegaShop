<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Les colonnes autorisées pour l'insertion en masse.
     */
    protected $fillable = [
        'product_id',
        'url',
        'alt',
        'is_primary',
        'sort_order',
    ];

    /**
     * Relation avec le produit parent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}