<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'is_processed', 'total'];

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public static function transferCartItemsAfterAuth()
    {
        $ip_address = request()->ip();
        $cart = Cart::where('ip_address', $ip_address)
            ->where('status', 1)
            ->first();
        if ($cart) {
            $total = $cart->total;
            $new_cart = Cart::where(['user_id' => auth('web')->user()->id, 'status' => 1])->first();

            if ($new_cart) {
                $total += $new_cart->total;
            }

            if (!$new_cart) {
                $new_cart = Cart::create([
                    'user_id' => auth('web')->user()->id,
                    'status' => 1,
                    'total' => 0
                ]);
            }

            if ($new_cart) {
                $new_cart->update([
                    'total' => $total
                ]);

                CartItem::where('cart_id', $cart->id)->update([
                    'cart_id' => $new_cart->id
                ]);
            }

            $cart->update([
                'total' => 0
            ]);
        }
    }
}
