<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total', 'payment', 'payment_method', 'full_name', 'phone_number', 'secondary_phone_number', 'province', 'district', 'city', 'landmark', 'order_note'];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
