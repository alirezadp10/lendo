<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property mixed id
 * @property mixed total_price
 * @property mixed status
 * @property mixed total_quantity
 * @property mixed month_count
 * @property mixed created_at
 * @property mixed updated_at
 * @mixin Builder
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'total_quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
