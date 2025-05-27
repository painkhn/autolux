<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'mileage',
        'year',
        'vin_code',
        'engine_type',
        'engine_volume',
        'engine_power',
        'transmission',
        'drive_type',
        'color',
        'body_type',
        'status',
        'brand_id',
        'image'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year' => 'date:Y', // Форматируем год как YYYY
        'engine_volume' => 'decimal:1', // Сохраняем 1 знак после запятой
        'price' => 'integer', // Для точных расчетов
        'mileage' => 'integer',
        'engine_power' => 'integer',
    ];

    /**
     * Get formatted price (рубли с пробелами).
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, '', ' ') . ' ₽';
    }

    /**
     * Get short year (только год без месяца и дня).
     */
    public function getYearOnlyAttribute(): string
    {
        return $this->year->format('Y');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}