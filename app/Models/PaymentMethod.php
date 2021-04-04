<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    use HasFactory;
    use \App\Traits\UsesUuid;

    protected $fillable = [
        'type',
        'customer_id'
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }

}
