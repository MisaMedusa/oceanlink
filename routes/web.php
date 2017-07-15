<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//home page
Route::get('/','HomeController@home');
Route::get('/iApply','HomeController@iApply');
Route::post('/iApply/insert','HomeController@insertiApply');

//Login
Route::get('/login','LoginController@home');
Route::post('/login/validateUsers','LoginController@validateUsers');
Route::get('/tlogin','LoginController@thome');
Route::post('/login/tvalidateUsers','LoginController@tvalidateUsers');

//Enrollee//
//Single
Route::get('/manage_app/enrollee','EnrolleeController@viewTrainingclass');
Route::get('/manage_app/enrollee/view/{id}','EnrolleeController@viewEnrollee');
Route::post('/manage_app/enrollee/insert','EnrolleeController@insertEnrollee');
Route::post('/manage_app/enrollee/application', 'EnrolleeController@application');

//Group Enroll
Route::get('/manage_app/genrollee','EnrolleeController@viewGEnrollee');
Route::post('/manage_app/genrollee/insert','EnrolleeController@insertGEnrollee');
Route::get('/manage_app/genrollee/view/{id}','EnrolleeController@viewGroupEnrollee');
Route::post('/manage_app/genrollee/view/set','EnrolleeController@markGroupEnrollee');
Route::post('/manage_app/genrollee/application','EnrolleeController@viewGApplication');
Route::post('/manage_app/genrollee/application/insert','EnrolleeController@insertGApplication');


//Collection
//Single
Route::get('/collection/single','CollectionController@viewSCollection');
Route::post('/collection/single/incash/insert','CollectionController@insertSCollection');

//Group
Route::get('/collection/group','CollectionController@viewCollection');
Route::post('/collection/group/incash/insert','CollectionController@insertInCashCollection');
Route::post('/collection/group/check/insert','CollectionController@insertCheckCollection');

//Payment History
Route::get('/collection/paymenthistory','CollectionController@viewHistory');

//Manage Enrollment
Route::get('/manage_enrollment','EnrollmentController@viewEnrollment');
Route::post('/manage_enrollment/insert','EnrollmentController@insertEnrollment');
Route::post('/manage_enrollment/enrollee','EnrollmentController@viewEnrollee');

//Students
//Route::get('/students','StudentController@viewStudents');

//admin page
Route::get('/admin', 'AdminController@home');
Route::get('/manage_app/gapplication', 'AdminController@gapplication');

//Maintenance//
//Employee
Route::get('/maintenance/employee', 'EmployeeController@viewEmployee' );
Route::post('/employee/insert', 'EmployeeController@createEmployee' );
Route::post('/employee/update', 'EmployeeController@updateEmployee' );
Route::post('/employee/delete', 'EmployeeController@deleteEmployee' );

//Position
Route::get('/maintenance/position','PositionController@viewPosition');
Route::post('/position/insert','PositionController@createPosition');
Route::post('/position/update','PositionController@updatePosition');
Route::post('/position/delete','PositionController@deletePosition');

//Training Officer
Route::get('maintenance/tofficer','TOfficerController@viewTOfficer');
Route::post('tofficer/insert','TOfficerController@insertTOfficer');
Route::post('tofficer/update','TOfficerController@updateTOfficer');
Route::post('tofficer/delete','TOfficerController@deleteTOfficer');
Route::get('maintenance/tofficer/archive','TOfficerController@viewArchive');
Route::post('tofficer/activate','TOfficerController@activateTOfficer');


//Training Room
Route::get('/maintenance/room','TrainingRoomController@viewRoom');
Route::post('/room/insert','TrainingRoomController@createRoom');
Route::post('/room/update','TrainingRoomController@updateRoom');
Route::post('/room/delete','TrainingRoomController@deleteRoom');
Route::get('/ajax-floor','TrainingRoomController@getFloor');
Route::get('/ajax-room','TrainingRoomController@getRoom');
Route::get('/maintenance/room/archive','TrainingRoomController@viewArchive');
Route::post('/room/activate','TrainingRoomController@activateRoom');

//Building
Route::get('/maintenance/building','BuildingController@viewBuilding');
Route::post('/building/insert','BuildingController@insertBuilding');
Route::post('/building/update','BuildingController@updateBuilding');
Route::post('/building/delete','BuildingController@deleteBuilding');
Route::get('/maintenance/building/archive','BuildingController@viewArchive');
Route::post('/building/activate','BuildingController@activateBuilding');

//Floor
Route::get('/maintenance/floor','FloorController@viewFloor');
Route::post('/floor/insert','FloorController@insertFloor');
Route::post('/floor/update','FloorController@updateFloor');
Route::post('/floor/delete','FloorController@deleteFloor');
Route::get('/maintenance/floor/archive','FloorController@viewArchive');
Route::post('/floor/activate','FloorController@activateFloor');

//Vessel
Route::get('/maintenance/vessel','VesselController@viewVessel');
Route::post('/vessel/insert','VesselController@insertVessel');
Route::post('/vessel/update','VesselController@updateVessel');
Route::post('/vessel/delete','VesselController@deleteVessel');
Route::get('/maintenance/vessel/archive','VesselController@viewArchive');
Route::post('/vessel/activate','VesselController@activateVessel');


//ProgramType
Route::get('/maintenance/ptype','ProgramTypeController@viewType');
Route::post('/type/insert','ProgramTypeController@insertType');
Route::post('/type/update','ProgramTypeController@updateType');
Route::post('/type/delete','ProgramTypeController@deleteType');
Route::post('/type/activate','ProgramTypeController@activateType');
Route::get('/maintenance/ptype/archive','ProgramTypeController@viewArchive');

//Program
Route::get('/maintenance/program','ProgramController@viewProgram');
Route::post('program/insert','ProgramController@insertProgram');
Route::post('program/update','ProgramController@updateProgram');
Route::post('program/delete','ProgramController@deleteProgram');
Route::get('/maintenance/program/archive','ProgramController@viewArchive');
Route::post('program/activate','ProgramController@activateProgram');

//Rate
Route::get('/maintenance/rate','RateController@viewRate');
Route::post('/rate/insert','RateController@insertRate');
Route::post('/rate/update','RateController@updateRate');
Route::post('/rate/delete','RateController@deleteRate');
Route::get('/maintenance/rate/archive','RateController@viewArchive');
Route::post('/rate/activate','RateController@activateRate');

//Schedule
/*
Route::get('maintenance/schedule','ScheduleController@viewSchedule');
Route::post('schedule/insert','ScheduleController@insertSchedule');
Route::post('schedule/update','ScheduleController@updateSchedule');
Route::post('schedule/delete','ScheduleController@deleteSchedule');
*/

//Maintenance End//


//Training Officer/tofficer/class/insertreport
Route::get('/tofficer/{id}','TrainingOfficerController@viewClass');
Route::post('/tofficer/class','TrainingOfficerController@Class');
Route::post('/tofficer/class/insertreport','TrainingOfficerController@insertReport');
Route::get('/tofficer/manage_enrollment/{id}','TrainingOfficerController@viewEnrollment');
Route::post('/tofficer/manage_enrollment/insert','TrainingOfficerController@insertEnrollment');
Route::post('/tofficer/manage_enrollment/set','TrainingOfficerController@MarkEnrollment');
Route::post('/tofficer/manage_enrollment/viewApplicants','TrainingOfficerController@viewApplicants');
Route::post('tofficer/class/attendance','TrainingOfficerController@MarkAttendance');


Route::post('tofficer/schedule/insert','TrainingOfficerController@insertSchedule');
Route::post('tofficer/schedule/update','TrainingOfficerController@updateSchedule');
Route::post('tofficer/schedule/delete','TrainingOfficerController@deleteSchedule');

//Receptionist
Route::get('receptionist','ReceptionistController@home');
Route::get('receptionist/application','ReceptionistController@viewApplication');

//Cashier
Route::get('cashier','CashierController@home');

Route::get('receipt',function(){
	return view('pdf.receipt');	
});

Route::get('receipt/print','CollectionController@printReceipt');