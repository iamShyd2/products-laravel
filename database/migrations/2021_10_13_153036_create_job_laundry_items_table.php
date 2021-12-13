<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;
use App\Models\LaundryItem;

class CreateJobLaundryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_laundry_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class);
            $table->foreignIdFor(LaundryItem::class);
            $table->string("price");
            $table->string("quantity");
            $table->string("total_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_laundary_items');
    }
}
