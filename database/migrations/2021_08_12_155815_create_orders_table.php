<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('status')->nullable();
            $table->double('total')->nullable();
            $table->boolean('payment')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('secondary_phone_number');
            $table->string('province');
            $table->string('district');
            $table->string('city');
            $table->string('landmark');
            $table->string('order_note')->nullable();
            $table->boolean('is_processed');
            $table->integer('processed_cart');
            $table->string('payment_ref')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
