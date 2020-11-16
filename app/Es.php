<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Es extends Model
{
    //
    protected $fillable = [
        'username', 'surname', 'firstname','middlename','ipssno','dateadded','level','phone',
        'email','user_id'
    ];
}
