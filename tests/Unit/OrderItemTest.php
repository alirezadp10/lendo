<?php

namespace Tests\Unit;

use App\Models\Installment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_must_belongs_to_an_order()
    {
        $item = OrderItem::factory()->create();

        $this->assertInstanceOf(BelongsTo::class,$item->order());

        $this->assertInstanceOf(Order::class,$item->order);
    }

    /**
     * @test
     */
    public function it_must_belongs_to_a_store()
    {
        $item = OrderItem::factory()->create();

        $this->assertInstanceOf(BelongsTo::class,$item->store());

        $this->assertInstanceOf(Store::class,$item->store);
    }

    /**
     * @test
     */
    public function it_may_have_many_installment()
    {
        $orderItem = OrderItem::factory()->create();

        Installment::factory(['order_item_id' => $orderItem->id])->count(3)->create();

        $this->assertInstanceOf(HasMany::class,$orderItem->installments());
    }

    /**
     * @test
     */
    public function when_new_order_item_created_installments_must_be_generated()
    {
        OrderItem::factory(['month_count' => 6])->create();

        $this->assertDatabaseCount('installments',6);
    }
}
