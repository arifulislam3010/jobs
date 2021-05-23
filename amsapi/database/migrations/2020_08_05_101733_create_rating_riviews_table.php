<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingRiviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_riviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agency_id')->unsigned();
            $table->integer('reviewer_id')->unsigned();
            $table->float('rating')->nullable();
            $table->Text('comment')->nullable();
            $table->integer('parent_comment_id')->nullable();
            $table->timestamps();
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_riviews');
    }
}
