<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->index(); // slug du blog 
            
            // $table->boolean('open')->default(false);
            $table->integer('date_start')->nullable();
            $table->integer('date_end')->nullable(); 
            
            $table->text('description')->nullable();

            $table->text('participants')->default('[]');
            $table->text('jury')->default('[]');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
