<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_orderdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('OrderID');
            $table->foreignId('P_ID');
            $table->string('P_Name');
            $table->integer('P_Quantity');
            $table->float('P_Price');
            $table->string('DetailNote')->nullable();
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
        Schema::dropIfExists('t_orderdetails');
    }
}
