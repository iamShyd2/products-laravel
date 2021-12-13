<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Invite;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteCreated;
use App\Http\Middleware\AuthenticateSuperAdmin;
use Mockery;
use Illuminate\Support\Facades\Log;

class UsersTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $user = User::role("Super Admin")->first();
        $this->actingAs($user);
    }

    public function test_creates_user_and_assigns_role()
    {
        $mock = $this->partialMock(AuthenticateSuperAdmin::class);
        $params = User::factory()
          ->make()
          ->toArray();
        $params["password"] = "12345678";
        $response = $this->post(route("users.index"), array_merge($params, ["role" => "Staff"]));
        $mock->shouldHaveReceived("handle")->with(Mockery::any(), Mockery::any());
        $response->assertSessionHasNoErrors();
        $lastUser = User::latest('id')->first();
        $this->assertEquals(true, $lastUser->hasRole("Staff"));
        $this->assertTrue(password_verify($params["password"], $lastUser->password));
        $response->assertRedirect(route("users.index"));
        $response->assertSessionHas('success', "User invited successfully");
    }

    public function test_deletes_user()
    {
        $user = User::factory()->create();
        $response = $this->delete(route("users.show", [$user]));
        $response->assertRedirect(route("users.index"));
        $this->assertDatabaseMissing("users", $user->toArray());
        $response->assertSessionHas('success', "User deleted successfully");
    }

}
