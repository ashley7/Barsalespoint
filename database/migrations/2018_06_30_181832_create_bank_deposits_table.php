<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankDepositsTable extends Migration
{
 
    public function up()
    {
        Schema::create('bank_deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('bank_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('deposited_by')->unsigned();
            $table->double('amount',10,2);           
            $table->string('date');
            $table->string('voucher_number')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('deposited_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_deposits');
    }
}
