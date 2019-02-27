<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function(Blueprint $table)
        {
            $table->increments('billno');
            $table->string('description');
            $table->string('supplierid');
            $table->string('billamount');
            //$table->string('paidamount');
            $table->string('createdbyuserid');
            //$table->string('status'); //unpaid, paid, partpaid
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
        Schema::drop('bills');
    }
}
