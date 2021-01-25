<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notis', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('img')->nullable();
            $table->text('desc')->nullable();
            $table->string('link')->nullable();
            $table->string('level')->nullable();
            $table->string('hashtag')->nullable();

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
        Schema::dropIfExists('notis');
    }
}
