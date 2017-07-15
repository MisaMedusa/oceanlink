<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classdetail extends Model
{
    public function trainingclass(){
    	return $this->belongsTo('App\Trainingclass');
    }

    public function enrollee(){
    	return $this->belongsTo('App\Enrollee');
    }
}
