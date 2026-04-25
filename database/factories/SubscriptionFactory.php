<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        $plan = $this->faker->randomElement(['monthly', 'yearly']);
        $status = $this->faker->randomElement(['pending', 'active', 'expired', 'cancelled']);
        $started = $this->faker->dateTimeBetween('-1 year', 'now');
        $expires = (clone $started)->modify($plan === 'monthly' ? '+1 month' : '+1 year');

        return [
            'user_id' => User::factory(),
            'plan' => $plan,
            'amount' => $plan === 'monthly' ? 50000 : 500000,
            'status' => $status,
            'started_at' => $started,
            'expires_at' => $expires,
        ];
    }
}
