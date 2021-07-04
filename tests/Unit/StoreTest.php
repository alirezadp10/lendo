<?php

namespace Tests\Unit;

use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_may_have_many_order_item()
    {
        $store = Store::factory()->create();

        OrderItem::factory(['store_id' => $store->id])->count(3)->create();

        $this->assertInstanceOf(HasMany::class,$store->orderItems());

        $this->assertCount(3,$store->orderItems);
    }
}
