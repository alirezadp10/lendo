<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Store
 * @package App\Models
 * @property mixed id
 * @property mixed name
 * @property mixed interest
 * @property mixed created_at
 * @property mixed updated_at
 * @mixin Builder
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interest'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
