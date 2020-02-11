<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBorrowingBook extends Model
{
    public function headBorrow(){
        return $this->belongsTo('App\HeadBorrowingBook', 'head_id');
    }
    public function book(){
        return $this->belongsTo('App\Book');
    }
}
