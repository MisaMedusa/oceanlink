<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupdetail extends Model
{
    public function groupapplication(){
    	return $this->belongsTo('App\Groupapplication');
    }

    public function enrollee(){
    	return $this->belongsTo('App\Enrollee');
    }
}
