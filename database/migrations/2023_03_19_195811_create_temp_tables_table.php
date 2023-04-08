<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_tables', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('sigle')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('email')->unique();
            $table->string('ifu')->unique();
            $table->string('sociale')->unique()->nullable();
            $table->string('pays');
            $table->string('adresse');
            $table->string('password');
            $table->string('role_id');
            $table->string('tel');
            $table->string('fixe')->nullable();
            $table->string('code');
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
        Schema::dropIfExists('temp_tables');
    }
}
