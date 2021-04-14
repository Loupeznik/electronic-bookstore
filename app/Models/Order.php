<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use \App\Traits\UsesUuid;
    use SoftDeletes;

    protected $fillable = [
        'sum',
        'vat',
        'status',
        'payment_method_id',
        'cart_id',
        'assignee',
        'customer_id',
        'shipping_id'
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'id', 'assignee');
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderReturn()
    {
        return $this->hasOne(OrderReturn::class);
    }

    public function orderTotal($currency = null)
    {
        return $this->sum + $this->vat . ' ' . $currency;
    }
}
