<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{

    use RefreshDatabase;

    public function test_gets_all_customers()
    {
        $response = $this->get('/customers');
        $response->assertStatus(200);
        $response->assertViewIs("customers.index");
    }

    public function test_stores_customer_into_datasebase_and_redirects_to_customers()
    {
        $customer = Customer::factory()->make();
        $response = $this->post("/customers", $customer->toArray());
        $response->assertRedirect("/customers");
        $this->assertDatabaseHas('customers', [
          'phone' => $customer->phone
        ]);
    }

    public function test_updates_customer_in_databse_and_redirects()
    {
        $customer = Customer::factory()->create();
        $newName = "New Customer Name";
        $response = $this->put("/customers/{$customer->id}", array_merge($customer->toArray(), [
            "name" => $newName
        ]));
        $response->assertRedirect("/customers");
        $this->assertDatabaseHas('customers', [
          'id'=> $customer->id,
          'name' => $newName
        ]);
    }

}
