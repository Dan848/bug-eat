<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();

            // Orders
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders")->cascadeOnDelete();
            // Products
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->references("id")->on("products")->cascadeOnDelete();

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
        Schema::dropIfExists('order_product');
    }
};
