<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCatagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catagories_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('posts_id')->unsigned();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('catagories_id')->unsigned();
            $table->foreign('catagories_id')->references('id')->on('catagories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('catagories_posts');
    }
}
