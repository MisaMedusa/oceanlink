<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Employee;
use App\User;
class EmployeeController extends Controller
{
    public function viewEmployee(){
    	$position = Position::all();
    	$employee = Employee::all()->where('active','=',1);
    	return view('admin.maintenance.employee',compact('position','employee'));
    }

    public function createEmployee(Request $request){
    	$user = new User;
    	$user->email = $request->email;
    	$user->password = $request->password;
    	$user->save();
    	$user = User::all();
    	$last = $user->last();
    	$user_id = $last->id;
    	$emp = new Employee;

    	$emp->firstName = $request->firstName;
    	$emp->middleName = $request->middleName;
    	$emp->lastName = $request->lastName;
    	$emp->street = $request->street;
    	$emp->barangay = $request->barangay;
    	$emp->city = $request->city;
    	$emp->dob = $request->dob;
    	$emp->gender = $request->gender;
    	$emp->contact = $request->contact;
    	$emp->position_id = $request->position_id;
    	$emp->user_id = $user_id;
    	$emp->save();
    	return redirect('maintenance/employee');
    }

    public function updateEmployee(Request $request)
    {
    	$emp = Employee::find($request->id);
    	$emp->firstName = $request->firstName;
    	$emp->middleName = $request->middleName;
    	$emp->lastName = $request->lastName;
    	$emp->street = $request->street;
    	$emp->barangay = $request->barangay;
    	$emp->city = $request->city;
    	$emp->dob = $request->dob;
    	$emp->gender = $request->gender;
    	$emp->contact = $request->contact;
    	$emp->position_id = $request->position_id;
    	$emp->user_id = $request->user_id;
    	$emp->save();
    	return redirect('maintenance/employee');
    }

    public function deleteEmployee(Request $request)
    {
    	$emp = Employee::find($request->id);
    	$emp->active = 0;
    	$emp->save();
    	return redirect('maintenance/employee');
    }
}
