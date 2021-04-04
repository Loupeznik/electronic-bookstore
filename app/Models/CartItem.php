<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'cart_id',
        'count'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
