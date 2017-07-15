<?php

namespace App\Http\Controllers;
use App\Scheduledprogram;
use Illuminate\Http\Request;
use App\Civilstatus;
class AdminController extends Controller
{
	public function home(){
		return view('admin.home');
	}

	public function gapplication(){
		$sprogram = Scheduledprogram::all()->where('active','=',1);
		return view('admin.manage_application.gapplication',compact('sprogram'));
	}
}
