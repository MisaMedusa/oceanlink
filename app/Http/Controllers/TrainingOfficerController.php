<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rate;
use App\Trainingofficer;
use App\Scheduledprogram;
use App\Trainingclass;
use App\classdetail;
use App\Groupapplication;
use App\Enrollee;
use Carbon\Carbon;
use App\Building;
use App\Floor;
use App\Vessel;
use App\Enrollmentreport;
use App\Attend;
class TrainingOfficerController extends Controller
{
    public function viewSchedule($id){
        $tclass = Trainingclass::all();
        $detail = Classdetail::All();
        $tofficer = Trainingofficer::find($id);
        /*
    	$scheduledprogram = Scheduledprogram::all()->where('active','=',1);
    	$program = Rate::all()->where('active','=',1);
    	$officer = Trainingofficer::find($id);
    	return view('/training_officer/schedule',compact('officer','program','scheduledprogram'));
        */
    }

    public function viewClass($id){
        $tclass = Trainingclass::all();
        $detail = Classdetail::All();
        $officer = Trainingofficer::find($id);
        $gapp = Groupapplication::all();
        $enrollee = Enrollee::all();
        $class = array();
        $x = 0;
        foreach($officer->sprog as $sprogs){
            $check = true;
            $count = 0;
            foreach($gapp as $gapps)
            {
                if($gapps->trainingclass->id == $sprogs->trainingclass->id)
                {
                    $check = false;
                }
            }
            foreach($detail as $details){
                if($details->trainingclass->id == $sprogs->trainingclass->id)
                {
                    $enrollee = $details->enrollee;
                    if($enrollee->status_id == 2)
                    {
                        $count++;
                    }
                }
            }
            if($check){
                if($sprogs->trainingclass->status == 2)
                {
                    $class[$x] =[
                        'class_name' => $sprogs->trainingclass->class_name,
                        'course_name' => $sprogs->rate->program->programName . ' ( ' . $sprogs->rate->duration . ' ' . $sprogs->rate->unit->unitName . ' )',
                        'no_students' =>$count,
                        'status' => 'On Going',
                        'trainingclass_id' =>$sprogs->trainingclass->id,
                        'trainingofficer_id' =>$officer->id,
                        ];
                }
            }
            $x++;
        }
        //return view('/training_officer/class',compact('officer','gapp'));
        return view('/training_officer/class',compact('class','officer'));
    }

    public function Class(Request $request){
        $officer = Trainingofficer::find($request->trainingofficer_id);
        $assesor = Trainingofficer::all()->where('active','=',1);
        $tclass = Trainingclass::find($request->trainingclass_id);
        $tclasses = Trainingclass::find($request->trainingclass_id);
        $sprog  = Scheduledprogram::find($tclass->scheduledprogram->id);
        $vessel = Vessel::all()->where('active','=',1);
        return view('/training_officer/students',compact('officer','tclass','sprog','vessel','assesor','tclasses'));
    }

    public function insertReport(Request $request){
        $report = new Enrollmentreport;
    }

    public function viewEnrollment(Request $request){
        $officer = Trainingofficer::find($request->id);
        $scheduledprogram = $officer->sprog;
        $rate = Rate::all()->where('active','=',1);
        $gapp = Groupapplication::all();
        $building = Building::all()->where('active','=',1);
        $buildings = $building->first();
        $floor = Floor::where('active','=',1)
                ->orderBy('building_id','ASC')->get();
        $class = array();
        $floorfirst = $floor->first();
        $x=0;
        $y=0;
        foreach($scheduledprogram as $sprogram){
            $check = true;
            $count = 0;
            $y=0;
            if($sprogram->trainingclass->status == 1)
            {    
                foreach($gapp as $gapps)
                {
                    if($gapps->trainingclass->id == $sprogram->trainingclass->id)
                    {
                        $check = false;
                    }
                }

                if($check)
                {
                    $class[$x] = [
                        'class_name' => $sprogram->trainingclass->class_name,
                        'course_name' => $sprogram->rate->program->programName .' ( ' .$sprogram->rate->duration . ' ' . $sprogram->rate->unit->unitName . ' )',
                        'dateStart' =>Carbon::parse($sprogram->dateStart)->format('M d, Y'),
                        'no_students' => count($sprogram->trainingclass->classdetail),
                        'status' => 'Not yet started',
                        'id' => $sprogram->id,
                    ];
                }
            }
            $x++;
        }
        return view('/training_officer/schedule',compact('officer','class','rate','floor','floorfirst'));
    }

    public function insertEnrollment(Request $request){
        $sprog = new Scheduledprogram;
        $sprog->dateStart = $request->dateStart;
        $sprog->rate_id = $request->rate_id;
        $sprog->trainingofficer_id = $request->tofficer_id;
        $sprog->save();
        $sprog= Scheduledprogram::all();
        $lastrate = $sprog->last();

        $class = new Trainingclass;
        $class->class_name = 'Class ' . $lastrate->id;
        $class->scheduledprogram_id = $lastrate->id;
        $class->trainingroom_id = $request->room_id;
        $class->save();

        return redirect('/tofficer/manage_enrollment/'.$request->tofficer_id.'');
    }

    public function viewApplicants(Request $request){
        $officer = Trainingofficer::find($request->trainingofficer_id);
        $sprog = Scheduledprogram::find($request->sprogram_id);
        $detail  = $sprog->trainingclass->classdetail;
        return view('/training_officer/applicants',compact('officer','sprog','detail'));
    }


    public function MarkEnrollment(Request $request){
        $officer = Trainingofficer::find($request->trainingofficer_id);
        $tclass = Trainingclass::find($request->id);
        $tclass->status = 2;
        $tclass->save();

        return redirect('/tofficer/manage_enrollment/'.$officer->id.'');
    }

    public function insertSchedule(Request $request)
    {
    	$rate = new Scheduledprogram;
    	$rate->dateStart = $request->dateStart;
    	$rate->rate_id = $request->rate_id;
    	$rate->tofficer_id = $request->tofficer_id;
    	$rate->save();
        $rate= Scheduledprogram::all();
        $lastrate = $rate->last();

        $class = new Trainingclass;
        $class->class_name = 'Class ' . $lastrate->id;
        $class->scheduledprogram_id = $lastrate->id;
        $class->save();

    	return redirect('tofficer/'.$request->tofficer_id.'');
    }

    public function updateSchedule(Request $request)
    {
        $rate = Scheduledprogram::find($request->id);
        $rate->dateStart = $request->dateStart;
        $rate->rate_id = $request->rate_id;
        $rate->tofficer_id = $request->tofficer_id;
        $rate->save();

        return redirect('tofficer/'.$request->tofficer_id.'');
    }

    public function deleteSchedule(Request $request)
    {
        $rate = Scheduledprogram::find($request->id);
        $rate->active = 0;
        $rate->save();

        return redirect('tofficer/'.$request->tofficer_id.'');
    }

    public function MarkAttendance(Request $request){
        $trainingofficer_id = $request->tofficer_id;
        for ($i=0; $i < count($request->enrollee_id); $i++)
        {
            $attend = new Attend;
            $attend->date = $request->attendance_date;
            $attend->enrollee_id = $request->enrollee_id[$i];
            $attend->status = $request->status[$i];
            $attend->save();
        }
        return redirect('tofficer/'.$request->tofficer_id.'');   
    }
}
