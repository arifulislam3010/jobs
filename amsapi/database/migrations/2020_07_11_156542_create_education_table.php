<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('board')->nullable();
            $table->string('passing_year')->nullable();
            $table->Text('degree_name')->nullable();
            $table->Text('institute')->nullable();
            $table->Text('subject')->nullable();
            $table->Text('grade')->nullable();
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
        Schema::dropIfExists('education');
    }
}
