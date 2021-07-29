<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticolTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articol_tag', function (Blueprint $table) {
            $table->primary(['articol_id','tag_id']);

            $table->unsignedBigInteger('articol_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('articol_id')->references('id')->on('articols')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articol_tag');

    }
}
