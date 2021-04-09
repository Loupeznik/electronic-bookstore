<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'nationality'
    ];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function bookCount()
    {
        return $this->hasMany(Book::class)->count();
    }

}
