<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('expense_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('description')->nullable();
        });
    }
  
    public function down()
    {
        Schema::dropIfExists('expense_accounts');
    }
}