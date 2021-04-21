<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'author_id',
        'price',
        'sale_price',
        'isbn',
        'language',
        'category_id',
        'publisher',
        'available',
        'description',
        'year',
        'photo_path'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function vatPrice($price)
    {
        return $price + ($price * (config('app.vat_pct', 21) / 100));
    }

    /**
     * Check if desired number of books is available
     * 
     * @param int $count
     * @return bool
     */
    public function checkAvailability(int $count)
    {
        if ($this->available > $count) return true;
        return false;
    }
}
