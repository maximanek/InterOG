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
            $table->string('OrderId')->foreign('OrderId')->references('OrderId')->on('orders');
            $table->string('LineItemId');
            $table->string('OfferId');
            $table->string('OfferExternalId');
            $table->string('Name');
            $table->smallInteger('Quantity');
            $table->float('Price');
            $table->string('Currency', 5);
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
