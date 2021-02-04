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
            $table->string('Type',5);
            $table->string('OrderId');
            $table->bigInteger('SellerId');
            $table->string('SellerLogin');
            $table->dateTimeTz('OrderDate');
            $table->string('SellerStatus',10);
            $table->string('BuyerId');
            $table->string('BuyerLogin');
            $table->string('BuyerEmail');
            $table->string('BuyerCompany')->nullable();
            $table->string('BuyerName');
            $table->string('BuyerPhone');
            $table->string('BuyerAddress');
            $table->string('BuyerZip', 7);
            $table->string('BuyerCity');
            $table->string('BuyerCountryCode',4);
            $table->string('PaymentId');
            $table->string('PaymentStatus');
            $table->string('PaymentProvider');
            $table->float('PaymentAmount');
            $table->string('PaymentCurrency', 4);
            $table->string('DeliveryMethod')->nullable();
            $table->float('DeliveryAmount')->nullable();
            $table->string('DeliveryCurrency', 4)->nullable();
            $table->string('DeliveryAddressCompanyName')->nullable();
            $table->string('DeliveryAddressName')->nullable();
            $table->string('DeliveryAddressPhone')->nullable();
            $table->string('DeliveryAddressStreet')->nullable();
            $table->string('DeliveryAddressZipCode')->nullable();
            $table->string('DeliveryAddressCity')->nullable();
            $table->string('DeliveryAddressCountry')->nullable();
            $table->string('DeliveryPickupPointId')->nullable();
            $table->string('DeliveryPickupPointName')->nullable();
            $table->string('DeliveryPickupPointStreet')->nullable();
            $table->string('DeliveryPickupPointZipCode')->nullable();
            $table->string('DeliveryPickupPointCity')->nullable();
            $table->string('InvoiceName')->nullable();
            $table->string('InvoiceCompanyName')->nullable();
            $table->string('InvoiceStreet')->nullable();
            $table->string('InvoiceZipCode')->nullable();
            $table->string('InvoiceCity')->nullable();
            $table->string('InvoiceCountry')->nullable();
            $table->string('InvoiceTaxId')->nullable();
            $table->float('TotalToPayAmount');
            $table->string('TotalToPayCurrency');
            $table->float('TotalPaidAmount');
            $table->string('TotalPaidCurrency');
            $table->mediumText('SellerNotes')->nullable();
            $table->mediumText('BuyerNotes')->nullable();
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
