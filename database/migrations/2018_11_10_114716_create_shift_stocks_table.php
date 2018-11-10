<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('old_stock')->nullable();
            $table->string('number');
            $table->string('new_stock')->nullable();
            $table->string('stock_left')->nullable();
            $table->integer('workshift_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('workshift_id')->references('id')->on('work_shifts')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_stocks');
    }
}
