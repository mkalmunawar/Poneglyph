<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBorrowingBook extends Model
{
    public function headBorrow(){
        return $this->belongsTo('App\HeadBorrowingBook');
    }
    public function book(){
        return $this->belongsTo('App\Book');
    }
}
