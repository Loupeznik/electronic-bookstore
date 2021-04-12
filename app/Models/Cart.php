<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use \App\Traits\UsesUuid;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'session_id'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function overallSum()
    {
        $sum = 0;
        foreach ($this->items as $item)
        {
            $sum += $item->book->price * $item->count;
        }
        return $sum;
    }
}
