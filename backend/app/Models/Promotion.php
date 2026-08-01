<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'discount_percent',
        'start_date',
        'end_date',
        'is_active',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}