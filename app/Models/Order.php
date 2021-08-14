<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['created_at_format'];

    protected $fillable = ['user_id', 'status', 'total', 'payment', 'payment_method', 'full_name', 'phone_number', 'secondary_phone_number', 'province', 'district', 'city', 'landmark', 'order_note'];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,  'id', 'user_id');
    }

    public function getCreatedAtFormatAttribute()
    {
        // return Carbon::now()->format('Y-m-d H:i:s');
        return Carbon::parse($this->created_at)->format('d-M-Y, H:i a');
    }
}
