<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatedShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated_shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('customer_id');
            $table->unsignedInteger('item_quantity');
            $table->decimal('value', 11,2);
            $table->decimal('discount', 11, 2)->nullable();
            $table->decimal('net_value', 11, 2)->nullable();
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
        Schema::dropIfExists('calculated_shopping_carts');
    }
}
