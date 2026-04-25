<?php

namespace Tests\Feature;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_subscription_list_with_filters_and_per_page()
    {
        // create an admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // create some users and subscriptions
        $users = User::factory()->count(3)->create();
        foreach ($users as $u) {
            Subscription::factory()->create(['user_id' => $u->id, 'status' => 'active']);
        }

        $this->actingAs($admin)
            ->get(route('admin.subscriptions.index', ['per_page' => 1, 'status' => 'active']))
            ->assertStatus(200)
            ->assertSee('Langganan')
            // should see only one subscription on the page
            ->assertSee('#1');
    }
}
