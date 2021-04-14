<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'cost'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_id', 'id');
    }
}
