<?php

namespace Database\Factories;

use App\Models\Installment;
use App\Models\InstallmentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallmentDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstallmentDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'installment_id'   => Installment::factory(),
            'installment_type' => $this->faker->word,
            'price'            => $this->faker->randomDigit,
        ];
    }
}
