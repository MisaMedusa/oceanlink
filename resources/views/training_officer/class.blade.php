@extends('training_officer.layouts.default')

@section('content')

<style type="text/css">
	.buttons{
		margin-left: 87.2%;
		margin-bottom: 2.5%;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>My Class</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success filterable" style="overflow:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>&ensp;&ensp;<big></big>
					</h3>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="20%">Class Name</th>
								<th width="30%">Course Name</th>
								<th width="15%">No. of Students</th>
								<th width="15%">Status</th>
								<th width="15">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($class as $classes)
							<tr>
								<td>{{$classes['class_name']}}</td>
								<td>{{$classes['course_name']}}</td>
								<td>{{$classes['no_students']}}</td>
								<td>{{$classes['status']}}</td>
								<td><form action="/tofficer/class" method="post">{{csrf_field()}}<input type="hidden" name="trainingclass_id" value="{{$classes['trainingclass_id']}}"><input type="hidden" name="trainingofficer_id" value="{{$classes['trainingofficer_id']}}"><button class="btn btn-primary">View</button></form></td>
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
	$('.sel-time-am').clockface();
	$('#attendance').addClass( "active" );
</script>
@endsection