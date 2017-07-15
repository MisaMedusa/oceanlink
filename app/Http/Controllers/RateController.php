<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Program;
use App\Rate;
use App\Day;

use App\Schedule;
use App\Scheduledetail;
use Carbon\Carbon;
class RateController extends Controller
{
    public function viewRate(){
        $rate = Rate::all()->where('active','=',1);
    	$unit = Unit::all();
    	$program = Program::all()->where('active','=',1);
        $day = Day::all();
    	return view('/admin/maintenance/rate',compact('unit','program','rate','day'));

    }

    public function insertRate(Request $request){
        $compare = true;
        $check = true;
        $messages = "";
        for($i = 0; $i <count($request->day_id); $i++)
        {
            if($i != count($request->day_id)-1)
            {
                for($a = $i+1; $a <count($request->day_id); $a++){
                    if($request->day_id[$i] == $request->day_id[$a])
                    {
                        $compare = false;
                        $check = false;
                        $messages .= "Invalid schedule input. ";
                    }
                }
            }
            if($compare)
            {
                if(Carbon::parse($request->start[$i])->gt(Carbon::parse($request->end[$i]))){
                    $check = false;
                    echo "1";
                }
                if(is_null(Carbon::parse($request->breakStart[$i])) && is_null(Carbon::parse($request->breakEnd[$i])))
                {

                }
                else
                {
                    if(Carbon::parse($request->breakStart[$i])->gt(Carbon::parse($request->breakEnd[$i]))){
                        $check = false;
                        $messages .= "Invalid schedule input. ";
                    }
                }
            }

            if($request->price<=0)
            {
                $check = false;
                $messages .= "Invalid price input. ";
            }
        }
        if($check)
        {
            $schedule = new Schedule;
            $schedule->save();
            $schedule = Schedule::all();
            $schedule = $schedule->last();
            for($i = 0; $i < count($request->day_id) ; $i++)
            {
                $detail = new Scheduledetail;
                $detail->schedule_id = $schedule->id;
                $detail->start = Carbon::parse($request->start[$i])->format('G:i:s');
                $detail->end = Carbon::parse($request->end[$i])->format('G:i:s');
                if(trim((Carbon::parse($request->breakStart[$i])->format('G:i:s')))=="" && trim((Carbon::parse($request->breakEnd[$i])->format('G:i:s')))=="")
                {
                    $detail->breakStart = NULL;
                    $detail->breakStart = NULL;
                }
                else
                {
                    $detail->breakStart = Carbon::parse($request->breakStart[$i])->format('G:i:s');
                    $detail->breakEnd = Carbon::parse($request->breakEnd[$i])->format('G:i:s');
                }
                $detail->day_id = $request->day_id[$i];
                $detail->save();
            }
            $rate = new Rate;
            $rate->program_id = $request->program_id;
            $rate->price =  $request->price;
            $rate->duration =  $request->duration;
            $rate->unit_id =  $request->unit_id;
            $rate->schedule_id = $schedule->id;
            $rate->save();
            $notification = array(
                'message' => 'New course has been successfully added', 
                'alert-type' => 'success'
            );

            return redirect('/maintenance/rate')->with($notification);
        }
        else{
            $notification = array(
                'message' => $messages, 
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
        
    }

    public function updateRate(Request $request){
        $compare = true;
        $check = true;
        $messages = "";
        for($i = 0; $i <count($request->day_id); $i++)
        {
            if($i != count($request->day_id)-1)
            {
                for($a = $i+1; $a <count($request->day_id); $a++){
                    if($request->day_id[$i] == $request->day_id[$a])
                    {
                        $compare = false;
                        $check = false;
                        $messages .= "Invalid schedule input. ";
                    }
                }
            }
            if($compare)
            {
                if(Carbon::parse($request->start[$i])->gt(Carbon::parse($request->end[$i]))){
                    $check = false;
                    $messages .= "Invalid schedule input. ";
                }
                if(is_null(Carbon::parse($request->breakStart[$i])) && is_null(Carbon::parse($request->breakEnd[$i])))
                {

                }
                else
                {
                    if(Carbon::parse($request->breakStart[$i])->gt(Carbon::parse($request->breakEnd[$i]))){
                        $check = false;
                        $messages .= "Invalid schedule input. ";
                    }
                }
            }

            if($request->price<=0)
            {
                $check = false;
                $messages .= "Invalid price input. ";
            }
        }
        echo $check;
        if($check)
        {

        	$rate = Rate::find($request->id);
            $deleteRows = Scheduledetail::where('schedule_id','=',$rate->schedule->id)->delete();
            for($i = 0; $i < count($request->day_id) ; $i++)
            {
                $detail = new Scheduledetail;
                $detail->schedule_id = $rate->schedule->id;
                $detail->start = Carbon::parse($request->start[$i])->format('G:i:s');
                $detail->end = Carbon::parse($request->end[$i])->format('G:i:s');
                if(trim((Carbon::parse($request->breakStart[$i])->format('G:i:s')))=="" && trim((Carbon::parse($request->breakEnd[$i])->format('G:i:s')))=="")
                {
                    $detail->breakStart = NULL;
                    $detail->breakStart = NULL;
                }
                else
                {
                    $detail->breakStart = Carbon::parse($request->breakStart[$i])->format('G:i:s');
                    $detail->breakEnd = Carbon::parse($request->breakEnd[$i])->format('G:i:s');
                }
                $detail->day_id = $request->day_id[$i];
                $detail->save();
            }

        	$rate->program_id = $request->program_id;
        	$rate->price =  $request->price;
        	$rate->duration =  $request->duration;
        	$rate->unit_id =  $request->unit_id;
        	$rate->save();

            $notification = array(
                'message' => 'Course has been successfully updated', 
                'alert-type' => 'success'
            );

        	return redirect('/maintenance/rate')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'Invalid Schedule', 
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function deleteRate(Request $request){
        $rate = Rate::find($request->id);
        $rate->active = 0;
        $rate->save();

        $notification = array(
            'message' => 'Course has been successfully removed', 
            'alert-type' => 'success'
        );


        return redirect('/maintenance/rate')->with($notification);
    }

    public function viewArchive(){
        $rate = Rate::all()->where('active','=',0);
        $unit = Unit::all();
        $program = Program::all()->where('active','=',1);
        $day = Day::all();
        return view('/admin/maintenance/archiverate',compact('unit','program','rate','day'));

    }

    public function activateRate(Request $request){
        $rate = Rate::find($request->id);
        $rate->active = 1;
        $rate->save();

        $notification = array(
            'message' => 'Course has been successfully activated', 
            'alert-type' => 'success'
        );


        return redirect('/maintenance/rate')->with($notification);
    }
}
