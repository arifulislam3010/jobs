<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('div_id')->unsigned();
            $table->integer('dis_id')->unsigned();
            $table->integer('subdis_id')->unsigned();
            $table->integer('union_id')->unsigned();
            $table->Text('village')->nullable();
            $table->Text('post_office')->nullable();
            $table->Text('road_no')->nullable();
            $table->Text('phone')->nullable();
            $table->integer('type')->nullable();
            $table->integer('same')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
