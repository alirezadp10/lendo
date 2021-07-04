<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    public function created(OrderItem $orderItem)
    {
        $this->generateInstallments($orderItem);

        $this->updateOrderPrice($orderItem);
    }

    private function generateInstallments(OrderItem $orderItem)
    {
        for ($turn = 1 ; $turn <= $orderItem->month_count ; $turn++) {
            $orderItem->installments()->create([
                'period_date' => now()->addMonths($turn - 1),
                'turn'        => $turn,
            ]);
        }
    }

    private function updateOrderPrice(OrderItem $orderItem)
    {
        $orderItem->order()->update([
            'total_price' => array_sum([
                $orderItem->price,
                config('lendo.installment_detail.vat_price'),
                config('lendo.installment_detail.delivery_price'),
                $orderItem->store->interest,
            ]),
        ]);
    }
}
