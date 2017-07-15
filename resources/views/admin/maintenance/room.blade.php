@extends('admin.layouts.default')

@section('content')
<style type="text/css">
	.buttons{
		margin-top: 10px;
		margin-bottom: 20px;
	}
</style>
<section class="content-header">
	<!--section starts-->
	<h1>Training Room Maintenance</h1>
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
		<li class="active">Training Room</li>
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
						<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Training Room</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="/maintenance/room/archive" class="buttons btn btn-success"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Archive</a>
					</div>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Room Number</th>
								<th width="10%">Capacity</th>
								<th width="25%">Building</th>
								<th width="25%">Floor</th>
								<th ></th>
								<th ></th>
							</tr>
						</thead>
						<tbody>
							@foreach($room as $rooms)
							<tr>
								<th width="15%">{{$rooms->room_no}}</th>
								<th width="10%">{{$rooms->capacity}}</th>
								<th width="25%">{{$rooms->building->buildingName}}</th>
								<th width="25%">{{$rooms->floor->floorName}}</th>
								<td align="center"><button class="btn btn-info" data-toggle="modal" data-href="#update{{$rooms->id}}" onclick="clicks({{$rooms->id}})" href="#update{{$rooms->id}}">Update</button></td>
								<td align="center"><form action="/room/delete" method="post">{{csrf_field()}}<input type="hidden" name="id" value="{{$rooms->id}}"><button type="submit" class="btn btn-info">Deactivate</button></form></td>
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
			<form id="create-form" action="/room/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Training Room</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Building Name &ensp;*</label>
								<div class="col-sm-8">
									<select required id="building" name="building_id" class="form-control">
										@foreach($building as $buildings)
										<option value="{{$buildings->id}}" >{{$buildings->buildingName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Floor Name &ensp;*</label>
								<div class="col-sm-8">
									<select required id="floor" name="floor_id" class="form-control">
									@foreach($floorfirst as $floors)
											<option value="{{$floors->id}}">{{$floors->floorName}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Room Number &ensp;*</label>
								<div class="col-sm-4">
									<input required type="text" class="form-control" name="room_no">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Capacity (max)&ensp;*</label>
								<div class="col-sm-4">
									<input required type="text" class="form-control" name="capacity">
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
@foreach($room as $rooms)
<div class="modal fade in" id="update{{$rooms->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form id="update-form{{$rooms->id}}" action="/room/update" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$rooms->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Update Training Room</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Building Name &ensp;*</label>
								<div class="col-sm-8">
									<select required id="{{$rooms->id}}" name="building_id" class="form-control" onchange="change(this.id)">
										@foreach($building as $buildings)
											@if($buildings->buildingName == $rooms->building->buildingName)
												<option selected value="{{$buildings->id}}" >{{$buildings->buildingName}}</option>
											@else
												<option value="{{$buildings->id}}" >{{$buildings->buildingName}}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Floor Name &ensp;*</label>
								<div class="col-sm-8">
									<select required id="floor{{$rooms->id}}" name="floor_id" class="form-control">
										<option value="{{$rooms->floor->id}}">{{$rooms->floor->floorName}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Room Number &ensp;*</label>
								<div class="col-sm-4">
									<input required type="text" value="{{$rooms->room_no}}" class="form-control" name="room_no">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Capacity (max)&ensp;*</label>
								<div class="col-sm-4">
									<input required type="text" value="{{$rooms->capacity}}" class="form-control" name="capacity">
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

	$("#maintenance").last().addClass( "active" );
	$("#room").last().addClass( "active" );

		$(document).on('change','#building',function(){
    		console.log('hmm its change');
    		var building_id = $(this).val();
    		var div = $(this).parent().parent();
   			var op=" ";
    		console.log(building_id);
    		$.ajax({
    			type:'get',
    			url:'{!!URL::to('ajax-floor')!!}',
    			data:{'id':building_id},
    			success:function(data){

					$('#floor').empty();
    				console.log('succes');
    				console.log(data);

    				console.log(data.length);
    				for(var i=0;i<data.length;i++){
    					$('#floor').append('<option value="'+data[i].id+'">'+data[i].floorName+'</option>');
    				}
    				
    			},
    			error:function(){

    			}
    		});
    	});
	});
	function change(id){
        var building_id = $('#'+id).val();
        $.ajax({
            type:'get',
            url:'{!!URL::to('ajax-floor')!!}',
            data:{'id':building_id},
            success:function(data){

                $('#floor'+id).empty();
                console.log('succes');
                console.log(data);

                console.log(data.length);
                for(var i=0;i<data.length;i++){
                    $('#floor'+id).append('<option value="'+data[i].id+'">'+data[i].floorName+'</option>');
                }
            },
            error:function(){

            }
        });
    }
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
}, "Numbers Only");

	$(function(){
		$('#create-form').validate({
			rules:{
				room_no:{
					required: true,
					regx: /(^[0-9]+$)/i,
					space: true,
				},
				capacity:{
					required: true,
					regx: /(^[0-9]+$)/i,
					space: true,
				}
			}
		});
	});

	function clicks(id){
		$('#update-form'+id).validate({
			rules:{
				room_no:{
					required: true,
					regx: /(^[0-9]+$)/i,
					space: true,
				},
				capacity:{
					required: true,
					regx: /(^[0-9]+$)/i,
					space: true,
				}
			}
		});
	};
</script>
@endsection