<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scheduledprogram;
use App\Civilstatus;
use App\Educationalbackground;
use App\Seaexperience;
use App\Contactperson;
use App\Trainingattend;
use App\Enrollee;
use Carbon\Carbon;
use App\Classdetail;
use App\Trainingclass;
class HomeController extends Controller
{
	public function home(){
		$sprogram = Scheduledprogram::all()->where('active','=',1);
		$sprog = $sprogram;
		return view('/home/welcome',compact('sprogram','sprog'));

		//update all status
		$tclass = Trainingclass::all()->where('status',1);
		Carbon::now('Asia/Singapore');
		/*
		foreach ($tclass as $tclass ) {
			if(Carbon::parse($tclass->scheduledprogram->dateStart)->lt(Carbon::now('Asia/Singapore'))){
				$class = Trainingclass::find($tclass->id);
				$class->status = 2;
				$class->save();
			}
		}
		*/
	}

	public function iApply(){
		$cstatus = Civilstatus::all();
		$sprogram = Scheduledprogram::all()->where('active','=',1);
		return view('/home/apply',compact('sprogram','cstatus'));
	}

	public function insertiApply(Request $request){
		$edub = new Educationalbackground;
		$edub->attainment = $request->attainment;
		$edub->school = $request->school;
		$edub->course = $request->course;
		$edub->save();
		$edub = Educationalbackground::All();
		$edub_last = $edub->last();
		if($request->noYears != "" && $request->rank)
		{
			$seaexp = new Seaexperience;
			$seaexp->noYears = $request->noYears;
			$seaexp->rank = $request->rank;
			$seaexp->save();
			$seaexp = Seaexperience::all();
			$seaexp_last = $seaexp->last();
		}

		$contactp = new Contactperson;
		$contactp->name = $request->name;
		$contactp->relationship = $request->relationship;
		$contactp->address = $request->address;
		$contactp->contact = $request->contact;
		$contactp->save();
		$contactp =Contactperson::all();
		$contactp_last = $contactp->last();

		$enrollee = new Enrollee;
		$enrollee->firstName = $request->firstName;
		$enrollee->middleName = $request->middleName;
		$enrollee->lastName = $request->lastName;
		$enrollee->gender = $request->gender;
		$enrollee->civilstatus_id = $request->civilstatus_id;
		$enrollee->dob = $request->dob;
		$enrollee->birthPlace = $request->birthPlace;
		$enrollee->street = $request->street;
		$enrollee->barangay = $request->barangay;
		$enrollee->city = $request->city;
		$enrollee->contact = $request->contact;
		$enrollee->email = $request->email;
		$enrollee->educationalbackground_id = $edub_last->id;
		$enrollee->contactperson_id = $contactp_last->id;
		if($request->noYears != "" && $request->rank)
		{
			$enrollee->seaexperience_id = $seaexp_last->id;
		}
		$enrollee->status_id = 1;
		$enrollee->save();
		$enrollee = Enrollee::all();
		$enrollee_last = $enrollee->last();
		$enrollee = Enrollee::find($enrollee_last->id);
		$enrollee->studentNumber = 'AP-'.Carbon::today()->format('Y').'-000'.$enrollee_last->id;
		$enrollee->save();
		for($x = 0; $x < count($request->trainingTitle) ; $x++ )
		{
			if($request->trainingTitle[$x] != "" && $request->trainingCenter[$x] != "" && $request->dateTaken[$x] != "")
			{
				$tattend = new Trainingattend;
				$tattend->trainingTitle = $request->trainingTitle[$x];
				$tattend->trainingCenter = $request->trainingCenter[$x];
				$tattend->dateTaken = $request->dateTaken[$x];
				$tattend->enrollee_id = $enrollee_last->id;
				$tattend->save();
			}
		}

		$classdetail = new Classdetail;
		$classdetail->enrollee_id = $enrollee_last->id;
		$classdetail->trainingclass_id = $request->sprog_id;
		$classdetail->save();
		return redirect('/');



	}
}
