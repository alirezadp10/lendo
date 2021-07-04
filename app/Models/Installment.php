<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Installment
 * @package App\Models
 * @property mixed id
 * @property mixed paid_at
 * @property mixed total_price
 * @property mixed period_date
 * @property mixed turn
 * @property mixed status
 * @property mixed created_at
 * @property mixed updated_at
 * @mixin Builder
 */
class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'paid_at',
        'total_price',
        'period_date',
        'turn',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(InstallmentDetail::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function mainPrice()
    {
        $item = $this->orderItem;

        $totalPrice = $item->price;

        $monthCount = $item->month_count;

        $interest = $item->store->interest;

        return ($totalPrice + $interest) / $monthCount;
    }
}
