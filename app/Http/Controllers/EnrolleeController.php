<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classdetail;
use App\Rate;
use App\Trainingofficer;
use App\Trainingclass;
use Carbon\Carbon;
use App\Scheduledprogram;
use App\Groupapplication;
use App\Groupscheduledetail;
use App\Groupschedule;
use App\Civilstatus;
use App\Groupdetail;
use App\Educationalbackground;
use App\Trainingattend;
use App\Contactperson;
use App\Seaexperience;
use App\Enrollee;
use App\Account;
use App\Day;
use App\Trainingroom;
class EnrolleeController extends Controller
{
    //Single Application
    public function viewTrainingclass(){
    	$tclass = Trainingclass::all()->where('status','=',1);
        $gapp = Groupapplication::all();
    	return view('admin/manage_application/enrollee',compact('tclass','gapp'));
    }

    public function viewEnrollee(Request $request){
        $tclass = Trainingclass::find($request->id);
        return view('admin/manage_application/viewenrollee',compact('tclass'));
    }

    public function application(Request $request){
        $tclass = Trainingclass::find($request->trainingclass_id);
        $cstatus = Civilstatus::all();
        $sprogram = Scheduledprogram::all()->where('active','=',1);
        return view('admin.manage_application.application',compact('sprogram','cstatus','tclass'));
    }

    public function insertEnrollee(Request $request){
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

        $balance = Scheduledprogram::find($request->sprog_id);
        $balance = $balance->rate->price;
        $accountnumber = Account::all();
        $accountnumber = count($accountnumber) + 1;
        $account = new Account;
        $account->paymentMode = $request->paymentMode;
        $account->balance = $balance;
        $account->accountNumber = 'GA-'.Carbon::today()->format('Y').'-000'.$accountnumber;
        $account->save();
        $account = Account::all();
        $account = $account->last();

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
        $enrollee->account_id = $account->id;
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
        $classdetail->trainingclass_id = $request->trainingclass_id;
        $classdetail->save();

        return redirect('/manage_app/enrollee/view/'.$request->trainingclass_id.'');
    }

    //Group Application
    public function viewGEnrollee(){
    	$tofficer = Trainingofficer::all()->where('active','=',1);
    	$rate = Rate::all()->where('active','=',1);
    	$gapp = Groupapplication::all()->where('active','=',1);
        $day = Day::all();
        $trainingroom = Trainingroom::all();
    	return view('admin/manage_application/genrollee',compact('rate','tofficer','gapp','day','trainingroom'));
    }

    public function insertGEnrollee(Request $request){
		$rate = new Scheduledprogram;
    	$rate->dateStart = $request->dateStart;
    	$rate->rate_id = $request->rate_id;
    	$rate->trainingofficer_id = $request->tofficer_id;
    	$rate->active=0;
    	$rate->save();
        $rate= Scheduledprogram::all();
        $lastrate = $rate->last();

        $class = new Trainingclass;
        $class->class_name = 'Class ' . $lastrate->id;
        $class->scheduledprogram_id = $lastrate->id;
        $class->trainingroom_id = $request->trainingroom_id;
        $class->save();
        $class = Trainingclass::all();
        $class_last = $class->last();
		
        $schedule = new Groupschedule;
        $schedule->save();
        $schedules = Groupschedule::all();
        $last = $schedules->last();
        for($i = 0; $i < count($request->day_id) ; $i++)
        {
            $sdetail = new Groupscheduledetail;
            $sdetail->day_id = $request->day_id[$i];
            $sdetail->start = Carbon::parse($request->start[$i])->format('G:i:s');
            $sdetail->end = Carbon::parse($request->end[$i])->format('G:i:s');
            $sdetail->breakStart = Carbon::parse($request->breakStart[$i])->format('G:i:s');
            $sdetail->breakEnd = Carbon::parse($request->breakEnd[$i])->format('G:i:s');
            $sdetail->groupschedule_id = $last->id;
            $sdetail->save();
        }

        $account = new Account;
        $account->paymentMode = $request->paymentMode;
        $account->save();
        $account = Account::all();
        $account = $account->last();

    	$gapp = new Groupapplication;
    	$gapp->orgName = $request->orgName;
    	$gapp->orgAddress = $request->orgAddress;
        $gapp->orgRepresentative = $request->orgRepresentative;
    	$gapp->trainingclass_id = $class_last->id;
    	$gapp->groupschedule_id = $last->id;
        $gapp->account_id = $account->id;
        $gapp->save();
        return redirect('/manage_app/genrollee');
    }

    public function markGroupEnrollee(Request $request)
    {
        $gapp = Groupapplication::find($request->id);
        count($gapp->groupdetail) * $gapp->trainingclass->scheduledprogram->rate->price;
        $gapp->status = 0;
        $gapp->save();
        $balance = count($gapp->groupdetail) * $gapp->trainingclass->scheduledprogram->rate->price;
        $accountnumber = Account::all();
        $accountnumber = count($accountnumber) + 1;
        $account = Account::find($gapp->account->id);
        $account->balance = $balance;
        $account->accountNumber = 'GA-'.Carbon::today()->format('Y').'-000'.$accountnumber;
        $account->save();

        return redirect('/manage_app/genrollee/view/'.$request->id.'');
    }

    public function viewGroupEnrollee(Request $request){
        $gapp = Groupapplication::find($request->id);
        /*
        $schedule="";
        foreach ($gapp->groupschedule->groupscheduledetail as $detail) {
            if($gapp->groupschedule->groupscheduledetail->last() == $detail)
            {
                $schedule .= $detail->day->dayName;
            }
            else
            {
                $schedule .=$detail->day->dayName . '-';
            }
        }
        $schedule .= '   '. Carbon::parse($gapp->groupschedule->start)->format('g:i A');
        $schedule .= ' - '. Carbon::parse($gapp->groupschedule->end)->format('g:i A');
        */

        return view('admin/manage_application/viewgenrollee',compact('gapp'));
    }

    public function viewGApplication(Request $request){
        $groupapplication_id = $request->id;
        $cstatus = Civilstatus::all();
        return view('admin/manage_application/gapplication',compact('groupapplication_id','cstatus'));
    }

    public function insertGApplication(Request $request){
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

        $gdetail = new Groupdetail;
        $gdetail->enrollee_id = $enrollee_last->id;
        $gdetail->groupapplication_id = $request->groupapplication_id;
        $gdetail->save();
        return redirect('/manage_app/genrollee/view/'.$request->groupapplication_id.'');
    }
}
