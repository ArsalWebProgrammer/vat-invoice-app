<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_address',
        'items',
        'subtotal',
        'vat',
        'total',
    ];

    protected $casts = [
        'items' => 'array',  // Cast items as an array for easier access
    ];
}
