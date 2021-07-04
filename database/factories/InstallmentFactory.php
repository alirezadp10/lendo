<?php

namespace Database\Factories;

use App\Models\Installment;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Installment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_item_id' => OrderItem::factory(),
            'total_price'   => $this->faker->randomDigit,
            'turn'          => $this->faker->randomDigit,
            'status'        => 'UNPAID',
            'period_date'   => $this->faker->date(),
            'paid_at'       => $this->faker->date(),
        ];
    }

    public function PAID()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'PAID',
            ];
        });
    }

}
