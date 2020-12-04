<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('img')->nullable();
            $table->string('timer')->nullable();

            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('price_off')->nullable();
            $table->string('award')->nullable();
            $table->string('conditions')->nullable();
            $table->string('link_signup')->nullable();
            $table->integer('status')->default('1');

            $table->string('etc')->nullable();
            $table->string('etc1')->nullable();

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
        Schema::dropIfExists('competitions');
    }
}
