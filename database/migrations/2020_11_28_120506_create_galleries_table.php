<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->string('img')->nullable();
            $table->string('times')->nullable();
            $table->string('kind')->nullable();
            $table->string('hashtag')->nullable();

            $table->text('images')->nullable();
            $table->text('desc2')->nullable();

            $table->string('etc')->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
