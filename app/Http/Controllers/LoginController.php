<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function home(){
    	return view('/login/login');
    }

    public function validateUsers(Request $request){
    	$user = User::all();
    	foreach($user as $users){
    		if(($users->email == $request->email) && ($users->password == $request->password))
    		{
    			if($users->employee->active == 1)
    			{
    				if($users->employee->position->positionName == 'Admin')
    				{
    					return redirect('/admin');
    				}
    			}
    		}
    	}
    }

    public function thome(){
        return view('/login/login2');
    }

    public function tvalidateUsers(Request $request){
        $user = User::all(); 
        foreach($user as $users){
            if(($users->email == $request->email) && ($users->password == $request->password))
            {
                if($users->tofficer->active == 1)
                {
                    $officer = $users->tofficer;
                    //return view('/training_officer/schedule',compact('officer'));
                    return redirect('/tofficer/'.$officer->id.'');
                }
            }
        }
    }
}
