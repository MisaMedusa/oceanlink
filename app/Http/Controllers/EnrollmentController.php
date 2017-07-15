<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainingofficer;
use App\Rate;
use App\Groupapplication;
use App\Building;
use App\Floor;
use App\Scheduledprogram;
use App\Trainingclass;
use Carbon\Carbon;
class EnrollmentController extends Controller
{
    public function viewEnrollment(){
        $officer = Trainingofficer::all()->where('active','=',1);
        $scheduledprogram = Scheduledprogram::all()->where('active','=',1);
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
            $i=0;
            $schedules="";
            foreach($sprogram->rate->schedule->detail as $schedule)
            {
            	$schedules[$i]= substr($schedule->day->dayName,0,3) . ' ' .Carbon::parse($schedule->start)->format('g:i  A') . ' - ' . Carbon::parse($schedule->end)->format('g:i A');
            	$i++;
            }
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
                        'schedule' => $schedules,
                    ];
                }
            }
            $x++;
        }
        return view('/admin/manage_enrollment/enrollment',compact('floorfirst','class','officer','rate','floor'));
    }

    public function insertEnrollment(Request $request){
    	$sprog = new Scheduledprogram;
        $sprog->dateStart = $request->dateStart;
        $sprog->rate_id = $request->rate_id;
        $sprog->trainingofficer_id = $request->officer_id;
        $sprog->save();
        $sprog= Scheduledprogram::all();
        $lastrate = $sprog->last();

        $class = new Trainingclass;
        $class->class_name = 'Class ' . $lastrate->id;
        $class->scheduledprogram_id = $lastrate->id;
        $class->trainingroom_id = $request->room_id;
        $class->save();

        return redirect('/manage_enrollment');
    }

    public function viewEnrollee(Request $request){
    	$sprog = Scheduledprogram::find($request->sprog_id);
        $detail = $sprog->trainingclass->classdetail;
        return view('admin/manage_enrollment/viewenrollee',compact('officer','sprog','detail'));
    }
}
