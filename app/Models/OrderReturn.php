<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'result',
        'description',
        'assignee_id',
        'completed_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function status()
    {
        switch($this->status)
        {
            case 0:
                return 'Received'; // Refund request received
                break;
            case 1:
                return 'Under review'; // Refund request is being looked into
                break;
            case 2:
                return 'Finished'; // Refund request was accepted or denied
                break;
        }
    }

    public function result()
    {
        switch($this->status)
        {
            case 0:
                return 'Order refunded';
                break;
            case 1:
                return 'Exchanged goods';
                break;
            case 2:
                return 'Return not accepted';
                break;
        }
    }
}
