<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('born')->nullable();
            $table->string('code_meli')->nullable();
            $table->string('phone')->nullable();
            $table->string('kind')->nullable();
            $table->string('has_gun')->nullable();
            $table->string('scan_shenasname')->nullable();
            $table->string('scan_pic')->nullable();
            $table->string('scan_bime')->nullable();

            $table->integer('creadit_has_gun')->default(0);
            $table->integer('creadit_no_gun')->default(0);

            $table->string('status')->default(1);

            $table->string('email')->unique();

            $table->string('password');
            $table->rememberToken();

            $table->string('etc')->nullable();
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
        Schema::dropIfExists('users');
    }
}
