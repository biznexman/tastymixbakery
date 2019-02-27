<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentmethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentmethods', function(Blueprint $table)
        {
            $table->increments('paymentmethodno');
            $table->string('paymentmethodtype');
            $table->string('paymentcardno');
            $table->string('cvv');
            $table->string('pin');
            $table->string('mobile');
            $table->string('cardexpiry');
            $table->string('description');
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
        Schema::drop('paymentmethods');
    }
}
