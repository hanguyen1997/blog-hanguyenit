<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_blogs', function (Blueprint $table) {
            $table->Increments('id_blog');
            $table->text('blog_code');
            $table->text('blog_title');
            $table->text('blog_keyword');
            $table->text('blog_description');
            $table->text('blog_content');
            $table->string('blog_image');
            $table->integer('blog_status');
            $table->integer('viewcount');
            $table->integer('id_user_create');
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
        Schema::dropIfExists('tbl_blogs');
    }
}
