<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forfeit extends Model
{
    public function headBorrow(){
        return $this->belongsTo('app\HeadBorrowingBook');
    }
}
