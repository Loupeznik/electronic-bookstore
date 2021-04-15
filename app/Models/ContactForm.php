<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'content',
        'assignee_id',
        'status'
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
