@extends('admin.layouts.default')

@section('content')
<style type="text/css">
	.divs{
		margin-bottom: 20px;
	}
	.buttons{
		margin-bottom: 20px;
		margin-left: 15px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>View Group Appplicants</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('/admin')}}">
				<i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
				Home
			</a> 
		</li>
		<li>
			<a >Transaction</a>
		</li>
		<li>
			<a >Manage Applications</a>
		</li>
		<li>
			<a >Group Application</a>
		</li>
		<li class="active">View Group Application</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success filterable" style="overflow:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
					</h3>
				</div>
				<div class="panel-body table-responsive">
					<div col-md-12>
					@if($gapp->status == 1)
						<div class="col-md-2">
							<form action="/manage_app/genrollee/application" method="post">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$gapp->id}}">
								<button type="submit" class="buttons btn btn-success" ><i class="glyphicon glyphicon-plus"></i>&ensp;New Student</button>
							</form>
						</div>
						<div class="col-md-3">
							<button type="submit" class="buttons btn btn-success" ><i class="glyphicon glyphicon-edit"></i>&ensp;Update Group Information</button>
						</div>
						<div class="col-md-2">
							<form action="/manage_app/genrollee/view/set" method="post">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$gapp->id}}">
								<button type="submit" class="buttons btn btn-success" ><i class="glyphicon glyphicon-edit"></i>&ensp;Set as Finalized</button>
							</form>
						</div>
					@endif
						<div class="col-md-3">
							<button class="buttons btn btn-success" data-toggle="modal" data-href="#schedule" href="#schedule"><i class="glyphicon glyphicon-eye-open"></i>&ensp;View Schedule</button>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-vertical">
							<div class="form-group">
								<label class="control-label">Organization Name :</label>
								<input  disabled class="form-control" value="{{$gapp->orgName}}">
							</div>
							<div class="form-group">
								<label class="control-label">Organization Address :</label>
								<input disabled class="form-control" value="{{$gapp->orgAddress}}">
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-vertical">
							<div class="form-group">
								<label class="control-label">Program Taken :</label>
								<input disabled type="text" class="form-control" value="{{$gapp->trainingclass->scheduledprogram->rate->program->programName . ' ( ' . $gapp->trainingclass->scheduledprogram->rate->duration. ' ' . $gapp->trainingclass->scheduledprogram->rate->unit->unitName . ' )'}}">
							</div>
							<div class="form-group">
								<label class="control-label">Training Officer :</label>
								<input disabled class="form-control" value="{{$gapp->trainingclass->scheduledprogram->trainingofficer->firstName . ' ' . $gapp->trainingclass->scheduledprogram->trainingofficer->middleName . ' ' . $gapp->trainingclass->scheduledprogram->trainingofficer->lastName}}">
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Student Number</th>
								<th width="25%">Student Name</th>
								<th width="30%">Student Address</th>
								<th width="10%">Age</th>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($gapp->groupdetail as $detail)
							<tr>
								<td>{{$detail->enrollee->studentNumber}}</td>
								<td>{{$detail->enrollee->firstName . ' ' . $detail->enrollee->middleName . ' ' . $detail->enrollee->lastName}}</td>
								<td>{{$detail->enrollee->street . ' ' . $detail->enrollee->barangay . ' ' . $detail->enrollee->city}}</td>
								<td>{{Carbon\Carbon::createFromFormat('Y-m-d',$detail->enrollee->dob)->age}}</td>
								<td><button type="submit" class="btn btn-primary">View</button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

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
								@foreach($gapp->groupschedule->groupscheduledetail as $detail)
								<tr>
									<td>{{$detail->day->dayName}}</td>
									<td>{{Carbon\Carbon::parse($detail->start)->format('g:i A') . ' - ' .Carbon\Carbon::parse($detail->end)->format('g:i A') }}</td>
									<td>{{Carbon\Carbon::parse($detail->breakStart)->format('g:i A') . ' - ' .Carbon\Carbon::parse($detail->breakEnd)->format('g:i A') }}</td>
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
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});
	$('.sel-time-am').clockface();
	$("#transaction").last().addClass( "active" );
	$("#manage_app").last().addClass( "active" );
	$("#group_app").last().addClass( "active" );
</script>
@endsection