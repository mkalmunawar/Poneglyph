<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadBorrowingBook extends Model
{
    public function member()
    {
        return $this->belongsTo('App\Members');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
    public function detailBorrow()
    {
        return $this->hasMany('App\DetailBorrowingBook', 'id');
    }
    public function forfeit()
    {
        return $this->hasMany('App\Forfeit');
    }
}
