<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'email',
        'phone_number',
        'address',
        'city',
        'country',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
