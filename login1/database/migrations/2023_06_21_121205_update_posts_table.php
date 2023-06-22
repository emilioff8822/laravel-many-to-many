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
        Schema::table('posts', function (Blueprint $table) {
            //1 creo la colonna della foreign key, il nome va dato al singolare
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //2 assegno la foreign key alla colonna creata ovvero dico che la colonna appena creata e una FK
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                //Voglio che nonostante cancello una categoria non voglio perdermi i post con quella categoria Lo faccio    togliendo l’eliminazioen a cascata
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //1 elimino la foreign key Tra parentesi devo mettere il nome della colonna quindi uso quadre
            $table->dropForeign(['category_id']);
            //2 cancella la colonna
            $table->dropColumn('category_id');
        });
    }
};