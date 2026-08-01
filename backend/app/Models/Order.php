<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'total_price',
        'status',

        'customer_name',
        'queue_number',

        'cash_received',
        'change_amount'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}