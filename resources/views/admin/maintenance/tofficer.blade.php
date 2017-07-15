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
	<h1>Training Officer Maintenance</h1>
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
		<li class="active">Training Officer</li>
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
					<div class="col-md-6">
						<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Training Officer</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="/maintenance/tofficer/archive" class="buttons btn btn-success"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Archive</a>
					</div>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="25%">Name</th>
								<th width="40%">Address</th>
								<th width="10%">Gender</th>
								<th width="5%">Age</th>
								<th width="10%"></th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($tofficer as $tofficers)
							<tr>
								<td>{{$tofficers->firstName . ' ' . $tofficers->middleName . ' '. $tofficers->lastName}}</td>
								<td>{{$tofficers->street . ' ' . $tofficers->barangay . ' ' . $tofficers->city}}</td>
								<td>@if($tofficers->gender == 'F')Female @else Male @endif</td>
								<td>{{Carbon\Carbon::createFromFormat('Y-m-d',$tofficers->dob)->age}}</td>
								<td align="center"><button class="btn btn-info" data-toggle="modal" data-href="#update{{$tofficers->id}}" onclick="clicks({{$tofficers->id}})" href="#update{{$tofficers->id}}">Update</button></td>
								<td align="center"><form action="/tofficer/delete" method="post">{{csrf_field()}}<input type="hidden" name="id" value="{{$tofficers->id}}"><button type="submit" class="btn btn-info">Deactivate</button></form></td>
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
			<form id="create-form" action="/tofficer/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Training Officer</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
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
								<label for="inputEmail3" class="col-sm-4 control-label">Date of Birth</label>
								<div class="col-sm-8">
									<input type="date" name="dob" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Contact &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="contact">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Sex &ensp;*</label>
								<div class="col-sm-8">
	                                <label class="radio-inline " for="example-inline-radio1">
	                                    <input type="radio" name="gender" value="M">Male</label>
	                                <label class="radio-inline" for="example-inline-radio2">
	                                    <input type="radio" name="gender" value="F">Female</label>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Email &ensp;*</label>
								<div class="col-sm-8">
									<input required name="email" type="email" class="form-control">
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

@foreach($tofficer as $tofficers)
<!--Update Modal-->
<div class="modal fade in" id="update{{$tofficers->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="update-form{{$tofficers->id}}" action="/tofficer/update" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$tofficers->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Update Training Officer</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">First Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$tofficers->firstName}}" class="form-control" name="firstName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Middle Name</label>
								<div class="col-sm-8">
									<input type="text" value="{{$tofficers->middleName}}" class="form-control" name="middleName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Last Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$tofficers->lastName}}" class="form-control" name="lastName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Street &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$tofficers->street}}" class="form-control" name="street">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Barangay &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$tofficers->barangay}}" class="form-control" name="barangay">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">City &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$tofficers->city}}" class="form-control" name="city">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Date of Birth &ensp;*</label>
								<div class="col-sm-8">
									<input type="date" value="{{$tofficers->dob}}" name="dob" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Contact Number &ensp;*</label>
								<div class="col-sm-8">
									<input type="text" required value="{{$tofficers->contact}}" class="form-control" name="contact">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Sex &ensp;*</label>
								<div class="col-sm-8">
	                                @if($tofficers->gender == 'M')
		                                <label class="radio-inline " for="example-inline-radio1">
		                                    <input checked type="radio" name="gender" value="M">Male</label>
		                                <label class="radio-inline" for="example-inline-radio1">
		                                    <input type="radio" name="gender" value="F">Female</label>
	                                @else
		                                <label class="radio-inline " for="example-inline-radio1">
		                                    <input  type="radio" name="gender" value="M">Male</label>
		                                <label class="radio-inline" for="example-inline-radio1">
		                                    <input checked type="radio" name="gender" value="F">Female</label>
	                                @endif
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

	$("#maintenance").last().addClass( "active" );
	$("#tofficer").last().addClass( "active" );
</script>
<script type="text/javascript">
	 @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
<script type="text/javascript">

$.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "No special characters except(hypen ( - ))");

$.validator.addMethod("regx1", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "No special characters except(hypen ( - ) and apostrophe ( ' ))");

$.validator.addMethod("regx2", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Invalid Input");

$.validator.addMethod("regx3", function(value, element) {          
    return this.optional(element) || /(^[a-zA-Z0-9 \'\-\Ñ\ñ]+$)/i.test(value) || value == "";
}, "Invalid Input");

$.validator.addMethod("regx4", function(value, element) {          
    return this.optional(element) || ((/(^[0-9]+$)/i.test(value)) && (value.length == 7 || value.length == 11));
}, "Invalid Input");

	$(function(){
		$('#create-form').validate({
			rules:{
				firstName:{
					required: true,
					regx1: /(^[a-zA-Z0-9 -\'\Ñ\ñ]+$)/i,
					space: true,
				},
				middleName:{
					regx3: true,
					space: true,
				},
				lastName:{
					required: true,
					regx1: /(^[a-zA-Z0-9 \'\-\Ñ\ñ]+$)/i,
					space: true,
				},
				street:{
					required: true,
					regx2: /(^[a-zA-Z0-9 \'\-\Ñ\ñ\#\.\,]+$)/i,
					space: true,
				},
				barangay:{
					required: true,
					regx2: /(^[a-zA-Z0-9 \'\-\Ñ\ñ\#\.\,]+$)/i,
					space: true,
				},
				city:{
					required: true,
					regx2: /(^[a-zA-Z ]+$)/i,
					space: true,
				},
				contact:{
					required: true,
					regx4: true,
					space: true,
				},
				email:{
					required: true,
					space: true,
					email: true,
				},
			}
		});
	});

	function clicks(id){
		$('#update-form'+id).validate({
			rules:{
				firstName:{
					required: true,
					regx1: /(^[a-zA-Z0-9 -\'\Ñ\ñ]+$)/i,
					space: true,
				},
				middleName:{
					regx3: true,
					space: true,
				},
				lastName:{
					required: true,
					regx1: /(^[a-zA-Z0-9 \'\-\Ñ\ñ]+$)/i,
					space: true,
				},
				street:{
					required: true,
					regx2: /(^[a-zA-Z0-9 \'\-\Ñ\ñ\#\.\,]+$)/i,
					space: true,
				},
				barangay:{
					required: true,
					regx2: /(^[a-zA-Z0-9 \'\-\Ñ\ñ\#\.\,]+$)/i,
					space: true,
				},
				city:{
					required: true,
					regx2: /(^[a-zA-Z ]+$)/i,
					space: true,
				},
				contact:{
					required: true,
					regx4: true,
					space: true,
				},
				email:{
					required: true,
					space: true,
					email: true,
				},
			}
		});
	};
</script>
@endsection
