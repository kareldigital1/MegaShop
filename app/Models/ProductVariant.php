<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    /**
     * Les colonnes autorisées pour l'insertion en masse.
     */
    protected $fillable = ['product_id', 'sku', 'price', 'old_price', 'quantity', 'is_active'];

    /**
     * Relation avec le produit parent.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relation avec les valeurs d'attributs.
     */
    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'variant_attributes');
    }
}