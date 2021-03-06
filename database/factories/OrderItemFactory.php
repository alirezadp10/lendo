<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id'    => Store::factory(),
            'order_id'    => Order::factory(),
            'price'       => $this->faker->randomDigit,
            'quantity'    => $this->faker->randomDigit,
            'month_count' => Arr::random([3, 6, 9, 12]),
        ];
    }
}
