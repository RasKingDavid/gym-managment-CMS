<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->integer('customer_id');
            $table->string('product_name');
            $table->string('product_sku');
            $table->integer('quantity');
            $table->integer('price');
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
        Schema::drop('shop_invoice_items');
    }
}
