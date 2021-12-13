<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Middleware\AuthenticateSuperAdmin;
use Mockery;
use Mockery\MockInterface;
use App\Models\User;
use App\Models\LaundryItem;
use Illuminate\Http\Request;

class LaundryItemTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $user = User::role("Super Admin")->first();
        $this->actingAs($user);
    }

    public function test_gets_all_laundary_items()
    {
        $response = $this->get('/laundry_items');
        $response->assertOk();
        $response->assertViewIs("laundry_items.index");
    }

    public function test_creates_laundary_item()
    {
        $mock = $this->partialMock(AuthenticateSuperAdmin::class);
        $laundry_item = LaundryItem::factory()->make()->toArray();
        $response = $this->post("/laundry_items", $laundry_item);
        $mock->shouldHaveReceived("handle")->with(Mockery::any(), Mockery::any());
        $response->assertRedirect("/laundry_items");
    }

}
