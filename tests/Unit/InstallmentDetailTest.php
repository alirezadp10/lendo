<?php

namespace Tests\Unit;

use App\Models\Installment;
use App\Models\InstallmentDetail;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InstallmentDetailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_must_belongs_to_an_installment()
    {
        $detail = InstallmentDetail::factory()->create();

        $this->assertInstanceOf(BelongsTo::class,$detail->installment());

        $this->assertInstanceOf(Installment::class,$detail->installment);
    }

    /**
     * @test
     */
    public function installment_detail_main_price_must_be_calculated()
    {
        $store = Store::factory(['interest' => 500000])->create();

        OrderItem::factory([
            'store_id'    => $store->id,
            'month_count' => 6,
            'price'       => 3000000,
            'quantity'    => 1,
        ])->create();

        $detail = InstallmentDetail::whereInstallmentType('main')->first();

        $this->assertEquals((string)((3000000 + 500000) / 6),$detail->price);
    }

}
