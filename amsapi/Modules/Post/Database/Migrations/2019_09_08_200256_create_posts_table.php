<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('shoulder')->nullable();
            $table->string('headline')->nullable();
            $table->string('hanger')->nullable();
            $table->string('designation')->nullable();
            $table->integer('author_id')->unsigned()->nullable();
            $table->integer('reporter_id')->unsigned()->nullable();
            $table->integer('featured_image_id')->unsigned()->nullable();
            $table->integer('featured_video_id')->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->integer('video_position')->nullable();
            $table->timestamp('share_at')->nullable();
            $table->date('expired_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('type')->default(0)->comment('1.job, 2.notice');
            $table->string('status')->nullable()->comment('1.published, 2.drafted, 3.success stories');
            $table->string('Instant_article')->nullable();
            $table->text('slug')->unique()->nullable();
            $table->text('image')->unique()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
