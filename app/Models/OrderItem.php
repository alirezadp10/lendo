<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * @package App\Models
 * @property mixed id
 * @property mixed price
 * @property mixed quantity
 * @property mixed month_count
 * @property mixed created_at
 * @property mixed updated_at
 * @mixin Builder
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'month_count',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
