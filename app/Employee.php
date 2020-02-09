<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function headBorrow(){
        return $this->hasMany('App\HeadBorrowingBook');
    }
}
