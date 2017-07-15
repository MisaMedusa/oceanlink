@extends('admin.layouts.default')

@section('content')
<style type="text/css">
	.buttons{
		margin-bottom: 20px;
		margin-right: 15px;
	}

	.divs{

		margin-bottom: 20px;
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
			<a >Manage Applications</a>
		</li>
		<li class="active">Single Application</li>
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
					<form action="/manage_app/enrollee/application" method="post">
					{{csrf_field()}}
					<input type="hidden" name="trainingclass_id" value="{{$tclass->id}}">
					<button type="submit" class="buttons btn btn-success" ><i class="glyphicon glyphicon-plus"></i>&ensp;New Individual Application</button>
					</form>
					<div class="divs col-md-12">
						<div class="col-md-6">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Class Name&ensp;:</label>
									<div class="col-sm-7">
										<input type="text" disabled value="{{$tclass->class_name}}" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Program Name&ensp;:</label>
									<div class="col-sm-7">
										<input type="text" disabled value="{{$tclass->scheduledprogram->rate->program->programName}}" class="form-control">
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="15%">Number</th>
								<th width="25%">Name</th>
								<th width="30%">Address</th>
								<th width="15%">Age</th>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tclass->classdetail as $tclass)
							<tr>
								<td>{{$tclass->enrollee->studentNumber}}</td>
								<td>{{$tclass->enrollee->firstName . ' ' . $tclass->enrollee->middleName . ' '. $tclass->enrollee->lastName}}</td>
								<td>{{$tclass->enrollee->street . ' ' . $tclass->enrollee->barangay . ' '. $tclass->enrollee->city}}</td>
								<td>{{Carbon\Carbon::createFromFormat('Y-m-d',$tclass->enrollee->dob)->age}}</td>
								<td><button type="button" class="btn btn-success" > View</button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
<script>
	$(document).ready( function(){
		var table = $('#table1').DataTable();
	});
	$("#transaction").last().addClass( "active" );
	$("#manage_app").last().addClass( "active" );
	$("#individual_app").last().addClass( "active" );
</script>
@endsection