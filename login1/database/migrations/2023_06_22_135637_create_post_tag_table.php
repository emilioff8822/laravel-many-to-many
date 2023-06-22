<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            //relazione con la tabella post
            //creo la colonna
            $table->unsignedBigInteger('post_id');
            //Creo la foreign key
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->cascadeOnDelete(); //con cascade all'eliminazione di  un post viene anche eliminata la relazione con il tag


                  //relazione con la tabella post
            //creo la colonna
            $table->unsignedBigInteger('tag_id');
            //Creo la foreign key
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
};
