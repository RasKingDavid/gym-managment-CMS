<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('invoice_number');
            $table->integer('sold_by');
            $table->integer('total');
            $table->integer('discounts');
            $table->integer('total_amount');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->integer('paid');
            $table->integer('debt');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pos_invoices');
    }
}
