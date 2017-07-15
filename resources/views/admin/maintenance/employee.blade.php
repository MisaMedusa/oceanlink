@extends('admin.layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
	.buttons{
		margin-top: 10px;
		margin-bottom: 20px;
	}
</style>
<section class="content-header">
	<!--section starts-->
	<h1>Employee Maintenance</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('/admin')}}">
				<i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
				Home
			</a>
		</li>
		<li>
			<a >Maintenance</a>
		</li>
		<li class="active">Employee</li>
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
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Employee</button>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Name</th>
								<th width="30%">Address</th>
								<th width="10%">Gender</th>
								<th width="5%">Age</th>
								<th width="15%">Position</th>
								<th width="10%"></th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($employee as $employees)
							<tr>
								<td>{{$employees->firstName . ' ' . $employees->middleName . ' '. $employees->lastName}}</td>
								<td>{{$employees->street . ' ' . $employees->barangay . ' ' . $employees->city}}</td>
								<td>@if($employees->gender == 'F')Female @else Male @endif</td>
								<td>{{Carbon\Carbon::createFromFormat('Y-m-d',$employees->dob)->age}}</td>
								<td>{{$employees->position->positionName}}</td>
								<td align="center"><button class="btn btn-info" data-toggle="modal" data-href="#update{{$employees->id}}" href="#update{{$employees->id}}">Update</button></td>
								<td align="center"><form action="/employee/delete" method="post">{{csrf_field()}}<input type="hidden" name="id" value="{{$employees->id}}"><button type="submit" class="btn btn-info">Deactivate</button></form></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Create Modal -->
<div class="modal fade in" id="responsive" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form action="/employee/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">First Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="firstName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Middle Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="middleName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Last Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="lastName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Street &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="street">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Barangay &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="barangay">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">City &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="city">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Date of Birth &ensp;*</label>
								<div class="col-sm-8">
									<input required type="date" name="dob" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Contact No. &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="contact">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Gender &ensp;*</label>
								<div class="col-sm-8">
	                                <label class="radio-inline " for="example-inline-radio1">
	                                    <input type="radio" name="gender" value="M">Male</label>
	                                <label class="radio-inline" for="example-inline-radio1">
	                                    <input type="radio" name="gender" value="F">Female</label>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Position &ensp;*</label>
								<div class="col-sm-8">
									<select required name="position_id" class="form-control">
										@foreach($position as $positions)
											<option value="{{$positions->id}}">{{$positions->positionName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Email&ensp;*</label>
								<div class="col-sm-8">
									<input required name="email" type="email" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Password &ensp;*</label>
								<div class="col-sm-8">
									<input required name="password" type="password" class="form-control">
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

<!--Update Modal-->
@foreach($employee as $employees)
<div class="modal fade in" id="update{{$employees->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form  action="/employee/update" method="post" class="form-horizontal">
				{{csrf_field()}}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Update Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="id" value="{{$employees->id}}">
							<input type="hidden" name="user_id" value="{{$employees->user_id}}">
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">First Name&ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->firstName}}" class="form-control" name="firstName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Middle Name</label>
								<div class="col-sm-8">
									<input type="text" value="{{$employees->middleName}}" class="form-control" name="middleName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Last Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->lastName}}" class="form-control" name="lastName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Street &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->street}}" class="form-control" name="street">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Barangay &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->barangay}}" class="form-control" name="barangay">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">City &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->city}}" class="form-control" name="city">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Date of Birth &ensp;*</label>
								<div class="col-sm-8">
									<input required type="date" value="{{$employees->dob}}" name="dob" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Contact No. &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$employees->contact}}" class="form-control" name="contact">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Gender</label>
								<div class="col-sm-8">
									@if($employees->gender == 'M')
		                                <label class="radio-inline " for="example-inline-radio1">
		                                    <input checked type="radio" name="gender" value="M">Male</label>
		                                <label class="radio-inline" for="example-inline-radio2">
		                                    <input type="radio" name="gender" value="F">Female</label>
	                                @else
		                                <label class="radio-inline " for="example-inline-radio1">
		                                    <input  type="radio" name="gender" value="M">Male</label>
		                                <label class="radio-inline" for="example-inline-radio2">
		                                    <input checked type="radio" name="gender" value="F">Female</label>
	                                @endif
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Position &ensp;*</label>
								<div class="col-sm-8">
									<select required name="position_id" class="form-control">
										@foreach($position as $positions)
											@if($positions->positionName == $employees->position->positionName)
												<option selected value="{{$positions->id}}">{{$positions->positionName}}</option>
											@else
												<option value="{{$positions->id}}">{{$positions->positionName}}</option>
											@endif
										@endforeach
									</select>
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
@endforeach
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});
</script>
@endsection