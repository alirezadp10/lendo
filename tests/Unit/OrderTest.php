<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_must_belongs_to_a_user()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(BelongsTo::class,$order->user());

        $this->assertInstanceOf(User::class,$order->user);
    }

    /**
     * @test
     */
    public function it_must_have_many_order_item()
    {
        $order = Order::factory()->create();

        OrderItem::factory(['order_id' => $order->id])->count(5)->create();

        $this->assertInstanceOf(HasMany::class,$order->items());

        $this->assertCount(5,$order->items);
    }

    /**
     * @test
     */
    public function order_total_price_equals_must_be_calculated()
    {
        $store = Store::factory(['interest' => 500000])->create();

        OrderItem::factory([
            'store_id'    => $store->id,
            'month_count' => 6,
            'price'       => 12000000,
            'quantity'    => 1,
        ])->create();

        $repayment = array_sum([
            12000000,
            config('lendo.installment_detail.vat_price'),
            config('lendo.installment_detail.delivery_price'),
            500000
        ]);

        $this->assertEquals($repayment,Order::first()->total_price);
    }
}
