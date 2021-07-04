<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_may_have_many_order()
    {
        $user = User::factory()->create();

        Order::factory(['user_id' => $user->id])->count(5)->create();

        $this->assertInstanceOf(HasMany::class,$user->orders());

        $this->assertCount(5,$user->orders);
    }
}
