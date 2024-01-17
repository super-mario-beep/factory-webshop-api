<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
