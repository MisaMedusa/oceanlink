<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Scheduledprogram;
use App\Civilstatus;
class ReceptionistController extends Controller
{
    public function home(){
    	return view('receptionist/home');
    }

    public function viewApplication(){
    	$cstatus = Civilstatus::all();
    	$sprogram = Scheduledprogram::all()->where('active','=',1);
    	return view('receptionist/application',compact('sprogram','cstatus'));
    }
}
