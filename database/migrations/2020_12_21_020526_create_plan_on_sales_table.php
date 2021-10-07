<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanOnSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_on_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('plan_id')->comment('this is the foreign key of from plan table');
            $table->integer('amount');
            $table->integer('discount')->default(0);
            $table->string('month')->comment('this is the months in word for the plan ');;
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
        Schema::drop('plan_on_sales');
    }
}
