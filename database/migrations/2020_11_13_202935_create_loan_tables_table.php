<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_tables', function (Blueprint $table) {
            $table->id();
            $table->string('letterofintroduction')->nullable(); //upload
            $table->string('docinvestigation')->nullable(); //upload
            $table->string('lastpromotion')->nullable(); //upload
            // info for next of kin
            $table->string('officeaddress')->nullable();
            $table->string('nextofkin')->nullable(); //upload whole document
            $table->string('deedguarantorpage1')->nullable(); //upload document
            $table->string('deedguarantorpage2')->nullable(); //upload document
            $table->string('deedguarantorpage3')->nullable(); //upload document
            $table->string('gaurantorsconfirmation')->nullable(); //upload
            $table->string('gaurantorsidcard')->nullable(); //upload //
            $table->string('gaurantorspassport')->nullable();     
            $table->string('payslip')->nullable(); //upload
                        $table->string('idcard')->nullable(); //upload
            $table->string('titleofdocument')->nullable(); //upload  for building loan
            $table->string('costofestimate')->nullable(); //upload for building loan
            $table->string('buildingplan')->nullable(); // for building loan
            
            $table->string('powerofattorney')->nullable(); // if title document not in your name (building loan)
            $table->string('declaration')->nullable(); //upload
            $table->string('certificateofhead')->nullable(); 
            $table->string('changeofname')->nullable();

            // specifics for fish loan  and purchasing loan
            $table->string('nameonlist')->nullable(); //upload (only for fish loan)
            $table->string('letterofoffer')->nullable(); // for both fish and purchasing
            $table->string('letterofundertaking')->nullable(); // for both fish and purchasing
            $table->string('reciept')->nullable(); // only necessary when loan is above cieling. (for both fish and processing)

            //specifics for home renovation loan
            $table->string('nhfpassbook')->nullable(); //upload
            $table->string('payslip2')->nullable(); //upload
            $table->string('payslip3')->nullable();  //upload
            $table->string('loantype');  //upload
            $table->string('guarantorspayslip')->nullable(); //upload
            $table->bigInteger('user_id')->unsigned(); //upload

            //others under title document
            $table->string('certificateofoccupancy')->nullable(); //upload
            $table->string('description')->nullable(); //upload //description and registetred number of title deeds

            //others 
            $table->string('noofyears')->nullable(); //upload
            $table->double('amount')->nullable(); //upload
            $table->string('formerloan')->nullable(); //upload
            $table->string('evidence')->nullable(); //upload
            $table->string('nameofagency')->nullable(); //upload
            $table->string('balance')->nullable(); //upload
            $table->string('conditions')->nullable(); //upload

            //other income
            $table->string('amountincome')->nullable(); //upload
            
           

                 //if yes
                 
                 $table->string('insuranceamount')->nullable(); //uploa   
                 


            //for purchasing 
            $table->string('vendorName')->nullable(); //upload
            $table->text('vendoraddress')->nullable(); //upload

            //part of documents for building loan

            $table->string('lettetofconsent')->nullable(); //uploa
            $table->string('letterlandandsurvey')->nullable(); //uploa
         
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_tables');
    }
}
