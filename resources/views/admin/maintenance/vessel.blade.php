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
	<h1>Vessel Maintenance</h1>
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
		<li class="active">Vessel</li>
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
						<button class="buttons btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive"><i class="glyphicon glyphicon-plus"></i>&ensp;New Vessel</button>
					</div>
					<div class="col-md-6 text-right" >
						<a href="/maintenance/vessel/archive" class="buttons btn btn-success"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Archive</a>
					</div>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Name</th>
								<th width="40%">Description</th>
								<th width="20%">Status</th>
								<th ></th>
								<th ></th>
							</tr>
						</thead>
						<tbody>
							@foreach($vessel as $vessels)
							<tr>
								<td>{{$vessels->vesselName}}</td>
								<td>{{$vessels->vesselDesc}}</td>
								@if($vessels->vesselStatus == 1)
								<td>Available</td>
								@else
								<td>Not Available</td>
								@endif
								<td align="center"><button class="btn btn-info" data-toggle="modal" data-href="#update{{$vessels->id}}" onclick="clicks({{$vessels->id}})" href="#update{{$vessels->id}}">Update</button></td>
								<td align="center"><form action="/vessel/delete" method="post">{{csrf_field()}}<input type="hidden" name="id" value="{{$vessels->id}}"><button type="submit" class="btn btn-info">Deactivate</button></form></td>
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
			<form id="create-form" action="/vessel/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">New Vessel</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" class="form-control" name="vesselName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Description </label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" rows="5" name="vesselDesc"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Status &ensp;*</label>
								<div class="col-sm-8">
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="1" >Available</label>
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="2" >Not Available</label>
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
@foreach($vessel as $vessels)
<div class="modal fade in" id="update{{$vessels->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form id="update-form{{$vessels->id}}" action="/vessel/update" method="post" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{$vessels->id}}" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Update Vessel</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" style="margin-bottom: 20px;">
							<h5><i>Note: </i><font color="red">&ensp;&ensp;* </font><i> fields are required</i></h5>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Name &ensp;*</label>
								<div class="col-sm-8">
									<input required type="text" value="{{$vessels->vesselName}}" class="form-control" name="vesselName">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Description</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" rows="5" name="vesselDesc">{{$vessels->vesselDesc}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-8">
									@if($vessels->vesselStatus == 1)
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="1" checked>Available</label>
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="2" >Not Available</label>
									@else
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="1" >Available</label>
									<label class="radio-inline" for="example-inline-radio2"><input type="radio" name="vesselStatus" value="2" checked>Not Available</label>
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
	$("#vessel").last().addClass( "active" );
</script><script type="text/javascript">
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
}, "No special characters except(hypen ( - ) and apostrophe ( ' )");

	$(function(){
		$('#create-form').validate({
			rules:{
				vesselName:{
					required: true,
					regx: /(^[a-zA-Z0-9 \'-]+$)/i,
					space: true,
				}
			}
		});
	});

	function clicks(id){
		$('#update-form'+id).validate({
			rules:{
				vesselName:{
					required: true,
					regx: /(^[a-zA-Z0-9 \'-]+$)/i,
					space: true,
				}
			}
		});
	};
</script>
@endsection