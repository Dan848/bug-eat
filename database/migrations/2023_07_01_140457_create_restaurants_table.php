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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string("name", 100)->unique();
            $table->string("type_1");
            $table->string("type_2");
            $table->string("slug", 255)->unique();
            $table->string("email", 255)->unique();
            $table->string("p_iva", 11)->unique();
            $table->string("phone_num", 20)->unique();
            $table->text("image")->nullable();
            $table->string("address", 255);
            //Foreign key
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();

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
        Schema::dropIfExists('restaurants');
    }
};
