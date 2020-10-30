<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    //

    protected $fillable = [
        'surname', 'firstname', 'middlename','user_id','serviceno','phone','maidenname',
        'dateOfBirth','state','lga','currentAddress','residentialAddress',
        'ministry', 'section', 'rank', 'level', 'step','pensionable',
'dateOfFirstAppointment', 'dateOfcurrentAppointment',
'bankname', 'accountno', 'accountname',
'gazzette', 'reason', 'surety', 'photo', 'pin','pid',
'payslip','appointmentConfirmation', 'fileNo', 'reason',
'verified'
    ];
}
