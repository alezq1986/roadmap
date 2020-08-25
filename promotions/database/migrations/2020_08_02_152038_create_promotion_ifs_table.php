<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionIfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_ifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained()->onDelete('cascade');
            $table->char('type');
            $table->char('amount_type');
            $table->string('product_id')->nullable();
            $table->unsignedInteger('category_level')->nullable();
            $table->string('category_id')->nullable();
            $table->decimal('quantity', 10, 4)->nullable();
            $table->decimal('value', 11, 2)->nullable();
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
        Schema::dropIfExists('promotion_ifs');
    }
}
