<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'name',
        'last_name',
        'father_name',
        'phone_number',
        'email',
        'address',
        'delivery_method',
        'status',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
