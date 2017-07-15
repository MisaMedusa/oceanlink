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
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="25%">Class Name</th>
								<th width="30%">Program Name</th>
								<th width="15%">No. of Students</th>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@if(count($gapp) == 0)
							@foreach($tclass as $tclass)
							<tr>
								<td>{{$tclass->class_name}}</td>
								<td>{{$tclass->scheduledprogram->rate->program->programName}}</td>
								<td>{{count($tclass->classdetail)}}</td>
								<td><a href="/manage_app/enrollee/view/{{$tclass->id}}" class="btn btn-success" > View</a></td>
							</tr>
							@endforeach
							@endif
							@foreach($tclass as $tclass)
								@foreach($gapp as $gapps)
									@if($gapps->trainingclass->id != $tclass->id)
									<tr>
										<td>{{$tclass->class_name}}</td>
										<td>{{$tclass->scheduledprogram->rate->program->programName}}</td>
										<td>{{count($tclass->classdetail)}}</td>
										<td><a href="/manage_app/enrollee/view/{{$tclass->id}}" class="btn btn-success" > View</a></td>
									</tr>
									@endif
								@endforeach
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