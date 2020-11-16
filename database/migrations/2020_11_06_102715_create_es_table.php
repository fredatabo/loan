<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('es', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
           
            $table->string('email')->unique()->nullable();
            $table->string('firstname')->nullable();
            $table->string('surname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('level')->nullable();
            $table->string('ipssno')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('user_id')->unsigned(); 
            $table->date('dateadded')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('es');
    }
}
