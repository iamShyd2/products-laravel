<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminTest extends TestCase
{

    use RefreshDatabase;

    public function test_admin_user_is_created_with_hashed_password_and_email()
    {
        $this->seed();
        $user = User::role("Super Admin")->first();
        $this->assertTrue("admin@gmail.com" == $user->email);
        $this->assertTrue(password_verifyconfig("app.password"), $user->password));
    }

}
