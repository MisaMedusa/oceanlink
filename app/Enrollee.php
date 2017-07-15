<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollee extends Model
{
    public function civilstatus(){
    	return $this->belongsTo('App\Civilstatus');
    }

    public function classdetail(){
    	return $this->hasOne('App\Classdetail');
    }

    public function groupdetail(){
    	return $this->hasOne('App\Groupdetail');
    }

    public function account(){
    	return $this->belongsTo('App\Account');
    }
}
