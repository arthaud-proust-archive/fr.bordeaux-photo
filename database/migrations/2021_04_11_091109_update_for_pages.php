<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('pages','id')) {

            Schema::table('pages', function (Blueprint $table) {
                $table->id();
            });
        }

        if (!Schema::hasColumn('infos','pages')) {


            Schema::table('infos', function (Blueprint $table) {
                $table->string('pages', 72); // tableau de 10 pages max ['eLz3','Dlz3',...,'emdZ'] -> 72 caractères
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
