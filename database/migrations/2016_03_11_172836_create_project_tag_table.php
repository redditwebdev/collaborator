<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tag', function (Blueprint $table) {
          $table->integer('project_id')->unsigned()->index();
          $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
          $table->integer('tag_id')->unsigned()->index();
          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::drop('project_tag');
    }
}
