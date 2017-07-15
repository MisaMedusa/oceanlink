@extends('training_officer.layouts.default')

@section('content')

<style type="text/css">
	.buttons{
		margin-top: 2.5%;
		margin-left: 2.8%;
	}

	.divs{
		margin-top: 20px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>View Class</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success filterable" style="overflow:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>&ensp;&ensp;<big></big>
					</h3>
				</div>
				<div>
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#schedule" href="#schedule"><i class="glyphicon glyphicon-eye-open"></i>&ensp;View Schedule</button>
					@if(count($tclass->enrollmentreport) < 1)
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#report" href="#report"><i class="glyphicon glyphicon-file"></i>&ensp;Set Enrollment Report</button>
					@endif
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#attend" href="#attend"><i class="glyphicon glyphicon-list-alt"></i>&ensp;Attendance</button>
				</div>
				<div class="divs col-lg-12">
					<div class="col-lg-6">
						<div class="form-vertical">
							<div class="form-group">
								<label class="control-label">Class Name :</label>
								<input  readonly class="form-control" value="{{$tclass->class_name}}">
							</div>
							<div class="form-group">
								<label class="control-label">Course Name :</label>
								<input readonly class="form-control" value="{{$tclass->scheduledprogram->rate->program->programName . ' ( ' . $tclass->scheduledprogram->rate->duration . ' ' . $tclass->scheduledprogram->rate->unit->unitName . ' )'}}">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-vertical">
							<div class="form-group">
								<label class="control-label">Date Started :</label>
								<input  readonly class="form-control" value="{{Carbon\Carbon::parse($tclass->scheduledprogram->dateStart)->format('F d, Y')}}">
							</div>
							<div class="form-group">
								<label class="control-label">Training Room :</label>
								<input readonly class="form-control" value="{{'Room ' . $tclass->trainingroom->room_no . ' ' . $tclass->trainingroom->building->buildingName . ' ' . $tclass->trainingroom->floor->floorName}}">
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Student Number</th>
								<th width="20%">Student Name</th>
								<th width="30%">Student Address</th>
								<th width="5%">Age</th>
								<th width="10%">Gender</th>
								<th width="15">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tclass->classdetail as $tclass)
								@if($tclass->enrollee->status_id == 2)
									<tr>
										<td>{{$tclass->enrollee->studentNumber}}</td>
										<td>{{$tclass->enrollee->firstName . ' ' . $tclass->enrollee->middleName . ' ' . $tclass->enrollee->lastName}}</td>
										<td>{{$tclass->enrollee->street . ' ' . $tclass->enrollee->barangay . ' ' . $tclass->enrollee->city}}</td>
										<td>{{Carbon\Carbon::createFromFormat('Y-m-d',$tclass->enrollee->dob)->age}}</td>
										@if($tclass->enrollee->gender == 'M')
											<td>Male</td>
										@else
											<td>Female</td>
										@endif
										<td><button class="btn btn-primary" >View</button></td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Attendance-->
<div class="modal fade in" id="attend" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form action="/tofficer/class/attendance" method="post">
			{{csrf_field()}}
				<input type="hidden" name="tofficer_id" value="{{$officer->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Mark Attendance</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-sm-2">Date: &ensp;</label>
									<div class="col-sm-4">
										<input required type="date" name="attendance_date" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="25%">Student Number</th>
											<th width="50%">Name</th>
											<th width="25%">Status</th>
										</tr>
									</thead>
									<tbody>
										@foreach($tclasses->classdetail as $tclasses)
										@if($tclasses->enrollee->status_id == 2)
											<tr>
												<td><input type="hidden" name="enrollee_id[]" value="{{$tclasses->enrollee->id}}">{{$tclasses->enrollee->studentNumber}}</td>
												<td>{{$tclasses->enrollee->firstName . ' ' . $tclasses->enrollee->middleName . ' ' . $tclasses->enrollee->lastName}}</td>
												<td><select class="form-control" name="status[]"><option value="1">Present</option><option value="0">Absent</option></select></td>
											</tr>
										@endif
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="Submit" class="btn btn-primary">Submit</button>
					<button type="button" data-dismiss="modal" class="btn">Close</button>
				</div>	
			</form>
		</div>
	</div>
</div>

<!--Schedule Modal-->
<div class="modal fade in" id="schedule" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">View Schedule</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="15%">Day</th>
									<th width="15%">Time</th>
									<th width="15%">Break Time</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sprog->rate->schedule->detail as $details)
									<tr>
										<td>{{$details->day->dayName}}</td>
										<td>{{Carbon\Carbon::parse($details->start)->format('g:i A') . ' - ' .Carbon\Carbon::parse($details->end)->format('g:i A') }}</td>
										<td>{{Carbon\Carbon::parse($details->breakStart)->format('g:i A') . ' - ' .Carbon\Carbon::parse($details->breakEnd)->format('g:i A') }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Close</button>
			</div>
		</div>
	</div>
</div>

<!--Reports-->
<div class="modal fade in" id="report" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">View Schedule</h4>
			</div>
			<div class="modal-body">
				<form action="/tofficer/class/insertreport">
					<div class="row">
						<div class="col-md-12">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Assesors&ensp;*</label>
									<div class="col-sm-7">
										<select class="form-control">
											@foreach($assesor as $assesors)
												<option value="{{$assesors->id}}">{{$assesors->firstName . ' ' . $assesors->middleName . ' ' . $assesors->lastName}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Practicum Vessel&ensp;*</label>
									<div class="col-sm-7">
										<select class="form-control">
											@foreach($vessel as $vessels)
												<option value="{{$vessels->id}}">{{$vessels->vesselName}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Practicum Date&ensp;*</label>
									<div class="col-sm-7">
										<input required type="date" name="date" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Training Director&ensp;*</label>
									<div class="col-sm-7">
										<input required type="text" name="trainingDirector" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Registrar&ensp;*</label>
									<div class="col-sm-7">
										<input required type="text" name="registrar" class="form-control">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Close</button>
				<button type="button" data-dismiss="modal" class="btn">Submit</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});
	$('#attendance').addClass( "active" );
</script>
@endsection