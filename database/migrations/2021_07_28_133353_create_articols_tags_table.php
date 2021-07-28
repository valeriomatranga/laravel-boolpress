<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticolsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articols_tags', function (Blueprint $table) {
            $table->primary(['articol_id','tag_id']);
            $table->unsignedBigInteger('articol_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->foreign('articol_id')->references('id')->on('articols');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articols_tags', function (Blueprint $table) {
            $table->dropForeign('articols_tag_articol_id_foreign');
            $table->dropForeign('articols_tag_tag_id_foreign');
            
        });
    }
}
