<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shopping_cart_id')->constrained()->onDelete('cascade');
            $table->integer('index');
            $table->string('product_id');
            $table->decimal('unit_value', 11, 2);
            $table->decimal('quantity', 10, 4);
            $table->decimal('value', 11, 2);
            $table->decimal('discount', 11, 2)->nullable();
            $table->decimal('net_unit_value', 11, 2)->nullable();
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
        Schema::dropIfExists('shopping_cart_items');
    }
}
