<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Les colonnes autorisées pour l'insertion en masse.
     */
    protected $fillable = [
        'store_name',
        'store_email',
        'store_phone',
        'store_currency',
        'store_address',
        'store_city',
        'store_zip',
        'store_country',
        'standard_shipping',
        'express_shipping',
        'standard_tax',
        'reduced_tax',
        'include_tax',
        'credit_card_enabled',
        'paypal_enabled',
        'bank_transfer_enabled',
        'order_confirmation_email',
        'shipping_confirmation_email',
        'review_request_email',
    ];
}
