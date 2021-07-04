<?php

namespace App\Observers;

use App\Models\Installment;

class InstallmentObserver
{
    public function created(Installment $installment)
    {
        $installment->details()->createMany(
            $installment->turn == 1 ? $this->vatAndDelivery() : $this->main($installment)
        );

        $installment->update([
            'total_price' => $installment->details->sum('price'),
        ]);
    }

    private function vatAndDelivery()
    {
        return [
            [
                'installment_type' => 'vat',
                'price'            => config('lendo.installment_detail.vat_price'),
            ],
            [
                'installment_type' => 'delivery',
                'price'            => config('lendo.installment_detail.delivery_price'),
            ],
        ];
    }

    private function main($installment)
    {
        return [
            [
                'installment_type' => 'main',
                'price'            => $installment->mainPrice(),
            ],
        ];
    }
}
