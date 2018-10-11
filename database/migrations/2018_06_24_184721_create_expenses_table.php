<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('date');
            $table->string('voucher_number');          
            $table->string('phone_number')->nullable(); 
            $table->string('person_name')->nullable();
            $table->double('amount',10,2);
            $table->text('particular')->nullable();
            $table->integer('expense_account_id')->unsigned();
            $table->foreign('expense_account_id')->references('id')->on('expense_accounts')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}