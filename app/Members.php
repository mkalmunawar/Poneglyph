<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    public function user(){
        return $this->belongsTo('app\user');
    }
    public function headBorrow(){
        return $this->hasMany('app\HeadBorrowingBook');
    }
}
