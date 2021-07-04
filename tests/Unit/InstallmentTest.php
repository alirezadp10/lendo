<?php

namespace Tests\Unit;

use App\Models\Installment;
use App\Models\InstallmentDetail;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InstallmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_must_belongs_to_an_order_item()
    {
        $installment = Installment::factory()->create();

        $this->assertInstanceOf(BelongsTo::class,$installment->orderItem());

        $this->assertInstanceOf(OrderItem::class,$installment->orderItem);
    }

    /**
     * @test
     */
    public function it_must_have_many_installment_detail()
    {
        $installment = Installment::factory()->create();

        $this->assertInstanceOf(HasMany::class,$installment->details());
    }

    /**
     * @test
     */
    public function first_installment_must_contain_vat_price()
    {
        OrderItem::factory()->create();

        $this->assertTrue(Installment::first()->details->contains('installment_type','vat'));
    }

    /**
     * @test
     */
    public function first_installment_must_contain_delivery_price()
    {
        OrderItem::factory()->create();

        $this->assertTrue(Installment::first()->details->contains('installment_type','delivery'));
    }

    /**
     * @test
     */
    public function installment_price_equals_to_sum_of_installment_detail_price()
    {
        $store = Store::factory(['interest' => 500000])->create();

        OrderItem::factory([
            'store_id'    => $store->id,
            'month_count' => 6,
            'price'       => 12000000,
            'quantity'    => 1,
        ])->create();

        Installment::all()->each(function ($installment){
            $this->assertEquals($installment->details->sum('price'),$installment->total_price);
        });
    }

    /**
     * @test
     */
    public function when_new_installment_created_details_must_be_generated()
    {
        Installment::factory()->create();

        $this->assertNotEmpty(InstallmentDetail::all());
    }
}
