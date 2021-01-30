<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offcodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->string('kind')->default('amount');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('count')->nullable();
            $table->string('kind_user')->nullable();

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
        Schema::dropIfExists('offcodes');
    }
}
