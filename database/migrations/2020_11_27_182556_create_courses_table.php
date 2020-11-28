<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('desc')->nullable();
            $table->string('img')->nullable();

            $table->string('hourse')->nullable();
            $table->string('count_hourse')->nullable();
            $table->string('price')->nullable();
            $table->string('price_off')->nullable();
            $table->string('deadline')->nullable();
            $table->string('documents')->nullable();
            $table->string('starting')->nullable();
            $table->string('quantity')->nullable();

            $table->string('etc')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
