<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyedApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyed_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('post_id');
            $table->integer('agency_id')->unsigned();
            $table->integer('applicant_id')->unsigned();
            $table->integer('status');
            $table->timestamps();
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applyed_applicants');
    }
}
