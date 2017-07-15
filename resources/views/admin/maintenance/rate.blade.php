@extends('admin.layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
	.buttons{
		margin-top: 10px;
		margin-bottom: 20px;
	}

	.buttonss{
		margin-left: 5px;
	}
</style>
<section class="content-header">
	<!--section starts-->
	<h1>Course Maintenance</h1>
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
		<li class="active">Rate</li>
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
						<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Course</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="/maintenance/rate/archive" class="buttons btn btn-success"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Archive</a>
					</div>
					
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="30%">Program Name</th>
								<th width="10%">Duration</th>
								<th width="10%">Unit</th>
								<th align="right" width="15%">&#8369; &ensp;&ensp;&ensp;&ensp;&ensp; Price</th>
								<th >Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($rate as $rates)
							<tr>
								<td>{{$rates->program->programName}}</td>
								<td>{{$rates->duration}}</td>
								<td>{{$rates->unit->unitName}}</td>
								<td align="right">{{number_format($rates->price,2)}}</td>
								<td align="center"><form action="/rate/delete" method="post"><button type="button" class="buttonss btn btn-info" data-toggle="modal" data-href="#update{{$rates->id}}" onclick="clicks({{$rates->id}})" href="#update{{$rates->id}}">Update</button>{{csrf_field()}}<input type="hidden" name="id" value="{{$rates->id}}"><button  type="submit" class="buttonss btn btn-info">Deactivate</button><button type="button" class="buttonss btn btn-info" data-toggle="modal" data-href="#view{{$rates->id}}" href="#view{{$rates->id}}">View Schedule</button></form></td>
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
			<form id="create-form" action="/rate/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Course</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Program Name&ensp;*</label>
								<div class="col-sm-8">
									<select required name="program_id" class="form-control">
										@foreach($program as $programs)
										<option value="{{$programs->id}}" >{{$programs->programName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Duration&ensp;*</label>
								<div class="col-sm-2">
									<input oninput="change()" id="duration" required type="text" name="duration" class="form-control" maxlength="2">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Unit</label>
								<div class="col-sm-2">
									<select onchange="change()" id="unit" name="unit_id" class="form-control">
										@foreach($unit as $units)
										<option value="{{$units->id}}" >{{$units->unitName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Price &ensp;*</label>
								<div class="col-sm-2">
									<input  value="0.00" required type="text" name="price" class="form-control text-right">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<thead id="dynamic1">
											</thead>
											<tbody id="dynamic">
											</tbody>
										</table>
									</div>
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
@foreach($rate as $rates)
<div class="modal fade in" id="update{{$rates->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="update-form{{$rates->id}}" action="/rate/update" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$rates->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Update Course</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Program Name &ensp;*</label>
								<div class="col-sm-8">
									<select required name="program_id" class="form-control">
										@foreach($program as $programs)
											@if($programs->programName == $rates->program->programName)
											<option selected value="{{$programs->id}}" >{{$programs->programName}}</option>
											@else
											<option value="{{$programs->id}}" >{{$programs->programName}}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Duration &ensp;*</label>
								<div class="col-sm-2">
									<input oninput="changes({{$rates->id}})" id="duration{{$rates->id}}" required type="text" name="duration" value="{{$rates->duration}}" class="form-control" maxlength="2">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Unit &ensp;*</label>
								<div class="col-sm-2">
									<select onchange="changes({{$rates->id}})" id="unit{{$rates->id}}" required name="unit_id" class="form-control">
										@foreach($unit as $units)
											@if($units->unitName == $rates->unit->unitName)
											<option selected value="{{$units->id}}" >{{$units->unitName}}</option>
											@else
											<option value="{{$units->id}}" >{{$units->unitName}}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Price &ensp;*</label>
								<div class="col-sm-2">
									<input align="right" required type="text" name="price" value="{{$rates->price}}" class="form-control text-right">
								</div>
							</div>
							<div class="form-group table-responsive">
								<table class="table table-striped table-bordered">
									<thead id="dynamic_field1{{$rates->id}}">
										<tr >
											<th width="16.66%">Day</th>
											<th width="16.66%">Time</th>
											<th width="16.66%">End</th>
											<th width="16.66%">Break Time</th>
											<th width="16.66%">Time</th>
											<th width="16.66%">End</th>
										</tr>
									</thead>
									<tbody id="dynamic_field{{$rates->id}}">
										@foreach($rates->schedule->detail as $detail)
										<tr>
											<td><select name="day_id[]" class="form-control">
												@foreach($day as $days)
												@if($detail->day_id == $days->id)
												<option selected value="{{$days->id}}">{{$days->dayName}}</option>
												@else
												<option value="{{$days->id}}">{{$days->dayName}}</option>
												@endif
												@endforeach
											</select></td>
											<td><input value="{{Carbon\Carbon::parse($detail->start)->format('g:i A')}}" data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td>
											<td><input value="{{Carbon\Carbon::parse($detail->end)->format('g:i A')}}" data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td>
											<td>Break Time</td>
											@if(is_null($detail->breakStart))
											<td></td>
											<td></td>
											@else
											<td><input value="{{Carbon\Carbon::parse($detail->breakStart)->format('g:i A')}}" data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td>
											<td><input value="{{Carbon\Carbon::parse($detail->breakEnd)->format('g:i A')}}" data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]">
											@endif
										</tr>
										@endforeach
									</tbody>
								</table>
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
@foreach($rate as $rates)
<!--Schedule Modal-->
<div class="modal fade in" id="view{{$rates->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
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
								@foreach($rates->schedule->detail as $detail)
								<tr>
									<td>{{$detail->day->dayName}}</td>
									<td>{{Carbon\Carbon::parse($detail->start)->format('g:i A') . ' - ' .Carbon\Carbon::parse($detail->end)->format('g:i A') }}</td>
									@if(is_null($detail->breakStart))
									<td></td>
									@else
									<td>{{Carbon\Carbon::parse($detail->breakStart)->format('g:i A') . ' - ' .Carbon\Carbon::parse($detail->breakEnd)->format('g:i A') }}</td>
									@endif
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
@endforeach
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});

	$("#maintenance").last().addClass( "active" );
	$("#course").last().addClass( "active" );
	function change(){
		$('#dynamic').empty();
		$('#dynamic1').empty();
		var duration = $('#duration').val()
		var unit = $('#unit').val();
		var i = 1;
		if(unit == 2)
		{
			if(duration>6)
			{
				$('#dynamic1').append('<tr><th width="15%">Day</th><th width="15%">Start</th><th width="15%">End</th><th width="15%">Break Time </th><th width="15%">Start</th><th width="15%">End</th><th width="10%"></th></tr>');
				$('#dynamic').append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button type="button" class="btn btn-success" id="add">Add more</button></td></tr>');
					$('.sel-time-am').clockface();

				$('#add').click(function(){
			        i++;
			        $('#dynamic').append('<tr id="row'+i+'"><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');

				$('.sel-time-am').clockface();
			    });
			    $(document).on('click','.remove',function(){
			        var btn_id = $(this).attr('id');
			        $('#row'+btn_id+'').remove();
			    });
			}
			else
			{
				$('#dynamic1').append('<tr><th width="16.66%">Day</th><th width="16.66%">Start</th><th width="16.66%">End</th><th width="16.66%">Break Time </th><th width="16.66%">Start</th><th width="16.66%">End</th></tr>');
				for (var x = 0 ; x < duration ; x++) {
					$('#dynamic').append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td></tr>');
					$('.sel-time-am').clockface();
				}
			}
		}
		else{
			$('#dynamic1').append('<tr><th width="15%">Day</th><th width="15%">Start</th><th width="15%">End</th><th width="15%">Break Time </th><th width="15%">Start</th><th width="15%">End</th><th width="10%"></th></tr>');
			$('#dynamic').append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button type="button" class="btn btn-success" id="add">Add more</button></td></tr>');
				$('.sel-time-am').clockface();

			$('#add').click(function(){
		        i++;
		        $('#dynamic').append('<tr id="row'+i+'"><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');

			$('.sel-time-am').clockface();
		    });
		    $(document).on('click','.remove',function(){
		        var btn_id = $(this).attr('id');
		        $('#row'+btn_id+'').remove();
		    });
		}
	}
	function changes(id){
		$('#dynamic_field'+id).empty();
		$('#dynamic_field1'+id).empty();
		var duration = $('#duration'+id).val();
		console.log(duration);
		var unit = $('#unit'+id).val();
		var i = 1;
		if(unit == 2)
		{
			if(duration>6)
			{
				$('#dynamic1').append('<tr><th width="15%">Day</th><th width="15%">Start</th><th width="15%">End</th><th width="15%">Break Time </th><th width="15%">Start</th><th width="15%">End</th><th width="10%"></th></tr>');
				$('#dynamic').append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button type="button" class="btn btn-success" id="add">Add more</button></td></tr>');
					$('.sel-time-am').clockface();

				$('#add').click(function(){
			        i++;
			        $('#dynamic').append('<tr id="row'+i+'"><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');

				$('.sel-time-am').clockface();
			    });
			    $(document).on('click','.remove',function(){
			        var btn_id = $(this).attr('id');
			        $('#row'+btn_id+'').remove();
			    });
			}
			else
			{
				$('#dynamic_field1'+id).append('<tr><th width="16.66%">Day</th><th width="16.66%">Start</th><th width="16.66%">End</th><th width="16.66%">Break Time </th><th width="16.66%">Start</th><th width="16.66%">End</th></tr>');
				for (var x = 0 ; x < duration ; x++) {
					$('#dynamic_field'+id).append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td></tr>');
					$('.sel-time-am').clockface();
				}
			}
		}
		else{
			$('#dynamic_field1'+id).append('<tr><th width="15%">Day</th><th width="15%">Start</th><th width="15%">End</th><th width="15%">Break Time </th><th width="15%">Start</th><th width="15%">End</th><th width="10%"></th></tr>');
			$('#dynamic_field'+id).append('<tr><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button type="button" class="btn btn-success" id="add">Add more</button></td></tr>');
				$('.sel-time-am').clockface();

			$('#add').click(function(){
		        i++;
		        $('#dynamic_field'+id).append('<tr id="row'+i+'"><td><select name="day_id[]" class="form-control">@foreach($day as $days)<option value="{{$days->id}}">{{$days->dayName}}</option>@endforeach</select></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="start[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="end[]"></td><td>Break Time </td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakStart[]"></td><td><input data-format="hh:mm A" class="form-control sel-time-am" type="text" name="breakEnd[]"></td><td><button name="remove" type="button" id="'+i+'" class="btn btn-danger remove" >X</button></td></tr>');

			$('.sel-time-am').clockface();
		    });
		    $(document).on('click','.remove',function(){
		        var btn_id = $(this).attr('id');
		        $('#row'+btn_id+'').remove();
		    });
		}
	}
$('.sel-time-am').clockface();	
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
}, "Invalid input amount");

$.validator.addMethod("regx3", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Numbers only");

$.validator.addMethod("regx4", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Invalid");

	$(function(){
		$('#create-form').validate({
			rules:{
				duration:{
					required: true,
					regx3 : /^[0-9]+$/i,
				},
				price:{
					required: true,
					regx2: /^(?:[0-9])*(?:|\.[0-9]+)$/i,
					space: true,
					maxlength: 10,
				},
			}
		});
	});

	function clicks(id){
		$('#update-form'+id).validate({
			rules:{
				duration:{
					required: true,
					regx3 : /^[0-9]+$/i,
					maxlength: 2,
				},
				price:{
					required: true,
					regx2 : /^(?:[0-9])*(?:|\.[0-9]+)$/i,
					space: true,
					maxlength: 10,
				},
			}
		});
	};
</script>
@endsection