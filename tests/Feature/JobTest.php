<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Job;
use App\Models\Customer;
use App\Models\User;
use App\Models\LaundryItem;
use App\Models\JobLaundryItem;
use App\Models\Branch;

use Tests\TestCase;

class JobTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $user = User::factory(["branch_id" => Branch::factory()->create()])->create();
        $user->assignRole("Staff");
        $this->actingAs($user);
    }

    function create_job_laundry_item($quantity, $job, $laundry_item)
    {
        $price = $laundry_item->price;
        JobLaundryItem::create([
          "job_id" => $job->id,
          "laundry_item_id" => $laundry_item->id,
          "quantity" => $quantity,
          "total_price" => $quantity * $price,
          "price" => $price
        ]);
    }

    public function test_get_all_jobs()
    {
        $response = $this->get('/jobs');
        $response->assertStatus(200);
        $response->assertViewIs("jobs.index");
    }

    public function test_stores_job_into_datasebase_and_redirects()
    {
        $laundry_items = LaundryItem::factory()->count(3)->create();
        $customer = Customer::factory()->create();
        $weight = 3;
        $per_weight_charge = 550;
        $total_price = $weight * $per_weight_charge;
        $total_price += 5000;
        $response = $this->post("/customers/".$customer->id."/jobs", [
          "weight" => $weight,
          "laundry_items" => [
            [
              "name" => $laundry_items->get(0)->id,
              "quantity" => 2
            ],
            [
              "name" => $laundry_items->get(1)->id,
              "quantity" => 1
            ]
          ]
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas("jobs", [
          "weight" => $weight,
          "per_weight_charge" => $per_weight_charge,
          "total_price" => $total_price,
          "state" => "Collected"
        ]);
        $this->assertEquals(2, JobLaundryItem::all()->count());
        $response->assertRedirect("/jobs");
    }

    public function test_stores_job_with_pickup_into_datasebase_and_redirects()
    {
        $laundry_items = LaundryItem::factory()->count(3)->create();
        $customer = Customer::factory()->create();
        $weight = 3;
        $per_weight_charge = 550;
        $total_price = $weight * $per_weight_charge;
        $total_price += 5000;
        $total_price += 5000;
        $response = $this->post("/customers/".$customer->id."/jobs", [
          "weight" => $weight,
          "pickup" => "on",
          "laundry_items" => [
            [
              "laundry_item_id" => $laundry_items->get(0)->id,
              "quantity" => 2
            ],
            [
              "laundry_item_id" => $laundry_items->get(1)->id,
              "quantity" => 1
            ]
          ]
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas("jobs", [
          "weight" => $weight,
          "per_weight_charge" => $per_weight_charge,
          "total_price" => $total_price,
          "state" => "Pickup"
        ]);
        $this->assertEquals(2, JobLaundryItem::all()->count());
        $response->assertRedirect("/jobs");
    }

}
