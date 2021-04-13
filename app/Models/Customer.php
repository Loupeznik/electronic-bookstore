<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'user_id',
        'street',
        'street_nr',
        'city',
        'zip',
        'country',
        'phone',
        'email'
    ];

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderCount()
    {
        return $this->hasMany(Order::class)->count();
    }

    public function hasUser()
    {
        if ($this->user != NULL) return true;
        return false;
    }
}
