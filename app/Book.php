<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function publisher(){
        return $this->belongsTo('App\Publisher');
    }
    public function detailBorrow(){
        return $this->hasMany('App\DetailBorrowingBook');
    }
}
