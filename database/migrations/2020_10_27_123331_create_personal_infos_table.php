<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('maidenname')->nullable();
            $table->string('serviceno')->unique()->nullable();
            $table->integer('accountno')->nullable()->unique();
            $table->string('bankname')->nullable();
            $table->string('accountname')->nullable();
            $table->string('phone')->nullable();
                        $table->string('ministry')->nullable();
            $table->string('section')->nullable();
            $table->date('dateOfBirth')->nullable(); //dateofbirth
            $table->string('rank')->nullable();
            $table->string('level')->nullable();
            $table->date('dateOfFirstAppointment')->nullable();
            $table->date('dateOfcurrentAppointment')->nullable();
            $table->string('step')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('pensionable')->nullable();
            $table->string('gazzette')->nullable(); //upload
            $table->string('surety')->nullable();  //upload
            $table->string('photo')->nullable(); //upload
           // $table->string('pensionFundAdmin')->nullable();
            $table->string('pin')->nullable();  // persid (pensionFundAdmin id)
            $table->text('currentAddress')->nullable();   
            $table->text('residentialAddress')->nullable();  
            $table->string('appointmentConfirmation')->nullable();  //upload
            $table->string('payslip')->nullable();  //upload   
            $table->string('fileNO')->nullable();  //auto generated after es confirms
            $table->string('reason')->nullable();  //upload
            $table->bigInteger('user_id')->unsigned(); //upload
            $table->bigInteger('pid')->unsigned()->nullable(); // pension fund table id
            $table->string('verified')->nullable();  //upload
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->on('users'); 

            /** 
            $table->foreign('pid')
            ->references('id')->on('pensionFunds');
           
*/
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_infos');
    }
}
