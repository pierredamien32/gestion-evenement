<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoutEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cout_events', function (Blueprint $table) {
            $table->double('cout');
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->foreignId('niveau_acces_id')->constrained()->onDelete('cascade');
            $table->primary(['evenement_id', 'niveau_acces_id']);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cout_events');
    }
}
