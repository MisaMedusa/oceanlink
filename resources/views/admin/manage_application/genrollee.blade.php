@extends('admin.layouts.default')

@section('content')
<style type="text/css">
	.buttons{
		margin-bottom: 20px;
		margin-right: 15px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>Applicants</h1>
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
			<a >Process Enrollment</a>
		</li>
		<li class="active">Group Application</li>
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
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Group Application</button>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Organization Name</th>
								<th width="30%">Organization Address</th>
								<th width="15%">No. of Students</th>
								<th width="20%">Class Name</th>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($gapp as $gapps)
							<tr>
								<td>{{$gapps->orgName}}</td>
								<td>{{$gapps->orgAddress}}</td>
								<td>{{count($gapps->groupdetail)}}</td>
								<td>{{$gapps->trainingclass->class_name}}</td>
								<td><a href="/manage_app/genrollee/view/{{$gapps->id}}" class="btn btn-primary">View</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<!--Create Modal-->
<div class="modal fade in" id="responsive" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="/manage_app/genrollee/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Group Applicants</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary filterable" style="overflow:auto;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title"><big>Set Program</big></h3>
			                    </div>
			                    <div class="panel-body">
									<div class="form-group">
										<label class="col-sm-3 control-label">Choose desired program</label>
										<div class="col-sm-8">
				                            <select class="form-control" name="rate_id" >
				                                @foreach($rate as $rates)
				                                <option value="{{$rates->id}}">{{$rates->program->programName.' ( '. $rates->duration. ' ' .$rates->unit->unitName .' )'}}</option>
				                                @endforeach
				                            </select>
			                            </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Training Room</label>
										<div class="col-sm-8">
				                            <select class="form-control" name="trainingroom_id" >
				                                @foreach($trainingroom as $trainingrooms)
				                                <option value="{{$trainingrooms->id}}">{{$trainingrooms->building->buildingName . ' ' . $trainingrooms->floor->floorName . ' room ' . $trainingrooms->room_no }}</option>
				                                @endforeach
				                            </select>
			                            </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Training Officer</label>
										<div class="col-sm-8">
				                            <select class="form-control" name="tofficer_id" >
				                                @foreach($tofficer as $tofficers)
				                                <option value="{{$tofficers->id}}">{{$tofficers->firstName . ' ' . $tofficers->middleName . ' ' . $tofficers->lastName }}</option>
				                                @endforeach
				                            </select>
			                            </div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Program Start</label>
										<div class="col-sm-8">
											<input type="date" name="dateStart" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Payment Method</label>
										<div class="col-sm-8">
											<label class="radio-inline"><input type="radio" name="paymentMode" value="1">Partial Payment</label>
                                            <label class="radio-inline"><input type="radio" name="paymentMode" value="2">Full payment</label>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-primary filterable" style="overflow:auto;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title"><big>Set Organization Information</big></h3>
			                    </div>
			                    <div class="panel-body">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Name</label>
										<div class="col-sm-8">
											<input type="text" name="orgName" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Address</label>
										<div class="col-sm-8">
											<input type="text" name="orgAddress" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-3 control-label">Representative</label>
										<div class="col-sm-8">
											<input type="text" name="orgRepresentative" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-primary filterable" style="overflow:auto;">
			                    <div class="panel-heading">
			                        <h3 class="panel-title"><big>Set Schedulue</big></h3>
			                    </div>
			                    <div class="panel-body table-responsive">
		                    		<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th width="15%">Day</th>
												<th width="15%">Start</th>
												<th width="15%">End</th>
												<th width="15%">Break</th>
												<th width="15%">Start</th>
												<th width="15%">End</th>
												<th width="10%"></th>
											</tr>
										</thead>
										<tbody id="dynamic_field">
											<tr>
												<td><select name="day_id[]" class="form-control">
														@foreach($day as $days)
														<option value="{{$days->id}}">{{$days->dayName}}</option>
														@endforeach
													</select>
												</td>
												<td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td>
												<td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td>
												<td>Break Time</td>
												<td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td>
												<td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td>
												<td><button type="button" class="btn btn-success" id="add">Add more</button></td>
											</tr>
										</tbody>
			                    	</table>
			                    </div>
			                </div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
        var i = 1;
		$('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time</td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');

		$('.sel-time-am').clockface();
        });
        $(document).on('click','.remove',function(){
            var btn_id = $(this).attr('id');
            $('#row'+btn_id+'').remove();
        });
	});

	$('.sel-time-am').clockface();
	$("#transaction").last().addClass( "active" );
	$("#manage_app").last().addClass( "active" );
	$("#group_app").last().addClass( "active" );
</script>
@endsection
