@extends('cashier.layouts.default')

@section('content')
<section class="content-header">
	<!--section starts-->
	<h1>Accounts</h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{url('/cashier')}}">
				<i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
				Home
			</a>
		</li>
		<li class="active">Accounts</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success filterable" style="overflow:auto;">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
						<button class="btn btn-success" data-toggle="modal" data-href="#responsive" href="#responsive">Accounts</button>
					</h3>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-bordered" id="table1">
						<thead>
							<tr>
								<th width="30%">Name</th>
								<th width="20%">Class</th>
								<th width="20%">Program Name</th>
								<th width="10%">Balance</th>
								<th width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
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
</script>
@endsection