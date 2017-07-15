<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainingclass extends Model
{
    public function scheduledprogram(){
    	return $this->belongsTo('App\Scheduledprogram');
    }

    public function classdetail(){
    	return $this->hasMany('App\Classdetail');
    }

    public function groupapplication(){
    	return $this->hasOne('App\Groupapplication');
    }

    public function classdetails(){
    	return $this->hasMany('App\Classdetail');
    }

    public function trainingroom(){
        return $this->belongsTo('App\Trainingroom');
    }

    public function enrollmentreport(){
        return $this->hasOne('App\Enrollmentreport');
    }
}
