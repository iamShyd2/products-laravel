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

    public function test_creates_user_assigns_role_and_invitation_and_sends_invitation_email_to_user()
    {
        Mail::fake();
        $this->seed();
        $user = User::role("Super Admin")->first();
        $mock = $this->partialMock(AuthenticateSuperAdmin::class);
        $this->actingAs($user);
        $params = User::factory()
          ->make()
          ->toArray();
        $response = $this->post(route("users.index"), array_merge($params, ["role" => "Staff"]));
        $response->assertRedirect();
        Mail::assertSent(InviteCreated::class);
        $lastUser = User::latest('id')->first();
        $this->assertDatabaseHas('users', $params);
        $this->assertEquals(true, $lastUser->hasRole("Staff"));
        $this->assertEquals(1, Invite::all()->count());
        $mock->shouldHaveReceived("handle")->with(Mockery::any(), Mockery::any());
    }

    /*public function test_renders_invite()
    {
        $invite = Invite::factory()->create();
        $token = $invite->token;
        $response = $this->get(route("staff.accept", ["token" => $token]));
        $response->assertStatus(200);
        $response->assertViewIs("staff.accept");
    }

    public function test_updates_user_passwords_deletes_invite_and_redirects_to_login()
    {
        $invite = Invite::factory()->create();
        $token = $invite->token;
        $response = $this->put(route("staff.accept", ["token" => $token]), [
          "password" => "12345678"
        ]);
        $response->assertRedirect("/login");
        $this->assertDatabaseMissing('invites', [
          'token' => $invite->token
        ]);
        $this->assertTrue(password_verify("12345678", $invite->user->password));
    }
    */

}
