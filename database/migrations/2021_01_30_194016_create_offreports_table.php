<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offreports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('offcode_id');
            $table->string('status');
            $table->string('price');

            $table->string('etc1')->nullable();
            $table->string('etc2')->nullable();

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
        Schema::dropIfExists('offreports');
    }
}
