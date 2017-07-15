@extends('training_officer.layouts.default')

@section('content')

<style type="text/css">
	.buttons{
		margin-left: 1.5%;
		margin-bottom: 2.5%;
	}

	.butt{
		margin-bottom: 5px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>Manage Enrollment</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success filterable" style="overflow:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>&ensp;&ensp;<big>List of Course for Class</big>
					</h3>
				</div>
				<div class="panel-body table-responsive">
					<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Class</button>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="15%">Class Name</th>
								<th width="25%">Course Name</th>
								<th width="15%">Date Start</th>
								<th width="15%">No. of Applicants</th>
								<th width="10%">Status</th>
								<th width="20%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($class as $classes)									
								<tr>
									<td>{{$classes['class_name']}}</td>
									<td>{{$classes['course_name']}}</td>
									<td>{{$classes['dateStart']}}</td>
									<td>{{$classes['no_students']}}</td>
									<td>{{$classes['status']}}</td>
									<td align="center"><form class="butt" action="/tofficer/schedule/delete" method="post"><input type="button" class="btn btn-info" data-toggle="modal" data-href="#update{{$classes['id']}}" href="#update{{$classes['id']}}" value="Update">{{csrf_field()}} <input type="hidden" name="tofficer_id" value="{{$classes['id']}}"> <input type="hidden" name="id" value="{{$classes['id']}}"><button type="submit" class="btn btn-info">Cancel</button></form>
									<form action="/tofficer/manage_enrollment/viewApplicants" method="post">{{csrf_field()}}<input type="hidden" name="trainingofficer_id" value="{{$officer->id}}"><input type="hidden" name="sprogram_id" value="{{$classes['id']}}"><button class="btn btn-info">View</button></form></td>
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
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form action="/tofficer/manage_enrollment/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="tofficer_id" value="{{$officer->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Class</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Course Name &ensp;*</label>
								<div class="col-sm-8">
									<select required name="rate_id" class="form-control">
									@foreach($rate as $rates)
										<option value="{{$rates->id}}">{{$rates->program->programName . ' ( ' . $rates->duration . ' ' . $rates->unit->unitName . ' )'}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Class Start &ensp;*</label>
								<div class="col-sm-8">
									<input required type="date" class="form-control" name="dateStart">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Floor &ensp;*</label>
								<div class="col-sm-8">
									<select id="floor" name="floor_id" class="form-control">
										@if(count($floor) > 1)
											@foreach($floor as $floors)
												<option value="{{$floors->id}}">{{$floors->building->buildingName . ' ' .$floors->floorName}}</option>
											@endforeach
										@else
											<option value="{{$floor->id}}">{{$floor->floorName}}</option>
										@endif
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Room &ensp;*</label>
								<div class="col-sm-8">
									<select required id="room" name="room_id" class="form-control">
										@foreach($floorfirst->trainingroom as $floors)
											<option value="{{$floors->id}}">{{$floors->room_no}}</option>
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

@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});
	$(document).on('change','#floor',function(){
    		var floor_id = $(this).val();
   			console.log(floor_id);
    		$.ajax({
    			type:'get',
    			url:'{!!URL::to('ajax-room')!!}',
    			data:{'floor_id':floor_id},
    			success:function(data){
					$('#room').empty();
    				for(var i=0;i<data.length;i++){
   						console.log(data[i].id);
    					$('#room').append('<option value="'+data[i].id+'">'+data[i].room_no+'</option>');
    				}
    			},
    			error:function(){

    			}
    		});
    	});
</script>
@endsection