<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('product_code')->unique();
            $table->text('short_description');
            $table->longText('description')->nullable();
            $table->integer('stock');
            $table->float('original_price');
            $table->boolean('discount')->default(false);
            $table->float('selling_price')->nullable();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('product_images')->nullable();

            //toogles
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);

            //specifications
            $table->longText('specifications')->nullable();

            //shipping details
            $table->float('weight')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();

            //SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();

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
        Schema::dropIfExists('products');
    }
}
