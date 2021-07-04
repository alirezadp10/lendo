<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstallmentDetail
 * @package App\Models
 * @property mixed id
 * @property mixed installment_type
 * @property mixed price
 * @property mixed created_at
 * @property mixed updated_at
 * @mixin Builder
 */
class InstallmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'installment_type',
        'price',
    ];

    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }
}
