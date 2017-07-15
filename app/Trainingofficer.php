<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainingofficer extends Model
{
    public function user(){
     	return $this->belongsTo('App\User');
    }

    public function sprog(){
    	return $this->hasMany('App\Scheduledprogram');
    }
}
