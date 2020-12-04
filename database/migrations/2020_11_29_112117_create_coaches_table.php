<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('gender')->nullable();
            $table->string('kind')->nullable();

            $table->string('degree')->nullable();
            $table->text('desc')->nullable();
            $table->string('img')->nullable();
            $table->string('img2')->nullable();
            $table->string('hashtag')->nullable();
            $table->string('guns')->nullable();

            $table->text('images')->nullable();
            $table->string('rank_show')->nullable();
            $table->string('color')->nullable();
            $table->string('honor')->nullable();

            $table->string('etc')->nullable();
            $table->string('etc1')->nullable();
            $table->string('etc2')->nullable();
            $table->string('etc3')->nullable();

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
        Schema::dropIfExists('coaches');
    }
}
