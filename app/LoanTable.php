<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanTable extends Model
{
    //

    protected $fillable = [
        'letterofintroduction', 'docinvestigation', 'lastpromotion',
        'officeaddress', 'nextofkin','deedguarantorpage1','deedguarantorpage2',
        'deedguarantorpage3', 'gaurantorsconfirmation', 'gaurantorsidcard',
        'gaurantorspassport', 'payslip', 'idcard', 'titleofdocument',
        'costofestimate','buildingplan', 'powerofattorney', 'declaration',
        'certificateofhead', 'changeofname','nameonlist','letterofoffer',
        'letterofundertaking', 'reciept', 'nhfpassbook', 'payslip2',
        'payslip3', 'guarantorspayslip', 'user_id', 'certificateofoccupancy',
        'description', 'noofyears', 'amount', 'formerloan','evidence',
        'nameofagency','balance','conditions' ,'amountincome','insuranceamount',
        'vendorName','vendoraddress', 'letterofconsent', 'letterlandsurvey'
    ];
}
