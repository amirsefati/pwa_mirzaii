<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skats', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('file')->nullable();
            $table->string('comment');
            $table->string('time')->nullable();
            $table->string('etc')->nullable();


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
        Schema::dropIfExists('skats');
    }
}
