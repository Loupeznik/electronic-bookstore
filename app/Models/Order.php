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
        'assignee_id',
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
        return $this->belongsTo(User::class, 'assignee_id', 'id');
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

    public function hasReturn()
    {
        if ($this->orderReturn != null) return true;
        return false;
    }

    public function orderTotal()
    {
        return $this->sum + $this->vat + $this->shippingMethod->cost . ' ' . config('app.currency', null);
    }

    public function status()
    {
        switch($this->status)
        {
            case 0:
                return 'Accepted'; // Order has been made and accepted into processing
                break;
            case 1:
                return 'In progress'; // Order is being processed
                break;
            case 2:
                return 'Completed'; // Order is complete
                break;
            case 3:
                return 'Cancelled'; // Order has been cancelled
                break;
            case 4:
                return 'Problem'; // Problem with the order (refund was requested, books no longer available)
                break;
        }
    }
}
