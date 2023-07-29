<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function sendOrder()
    {
        return $this->hasOne(SendOrder::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
