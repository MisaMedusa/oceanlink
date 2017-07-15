@extends('admin.layouts.default')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<!--section starts-->
	<h1>Group Collection</h1>
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
			<a >Collections</a>
		</li>
		<li class="active">Group Collection</li>
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
								<th width="15%">Account Number</th>
								<th width="30%">Applicants Name</th>
								<th width="15%">&#8369; &ensp;&ensp;&ensp;&ensp;&ensp;Balance</th>
								<th width="30%">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($class as $class)
							@if($class->enrollee->account->balance > 0)
							<tr>
								<td>{{$class->enrollee->account->accountNumber}}</td>
								<td>{{$class->enrollee->firstName . ' ' . $class->enrollee->middleName . ' ' . $class->enrollee->lastName}}</td>
								<td align="right">{{number_format($class->enrollee->account->balance,2)}}</td>
								<td>&ensp;<button class="btn btn-primary" data-toggle="modal" data-href="#incash{{$class->id}}" onclick="clicks({{$class->id}})" href="#incash{{$class->id}}"><i class="fa fa-money" aria-hidden="true"></i>&ensp;In Cash Payment</button>							
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@foreach($classes as $class)
<div class="modal fade in" id="incash{{$class->id}}" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form id="collection-form{{$class->id}}" action="/collection/single/incash/insert" method="post" class="form-horizontal">
				{{ csrf_field() }}
                <input type="hidden" id="class_id" value="{{$class->id}}">
				<input type="hidden" name="account_id" value="{{$class->enrollee->account->id}}">
				<input type="hidden" name="enrollee_id" value="{{$class->enrollee->id}}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">In Cash Payment</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" name="paymentDate" value="{{Carbon\Carbon::today()->format('F d, Y')}}">
								<label class="col-md-12 control-label">{{Carbon\Carbon::today()->format('F d, Y')}}</label>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Transaction Number&ensp;:</label>
								<div class="col-sm-5">
									<input type="hidden" name="paymentNumber" value="TN-{{Carbon\Carbon::today()->format('Y')}}-000{{count($payment)+1}}">
									<input disabled value="TN-{{Carbon\Carbon::today()->format('Y')}}-000{{count($payment)+1}}" name="paymentNumber" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Account Number&ensp;:</label>
								<div class="col-sm-5">						
									<input disabled value="{{$class->enrollee->account->accountNumber}}" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Balance&ensp;:</label>
								<div class="col-sm-5">				
									<input disabled value="&#8369; &ensp;&ensp;{{number_format($class->enrollee->account->balance,2)}}" class="form-control text-right">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Mode of Payment&ensp;:</label>
								<div class="col-sm-5">
								@if($class->enrollee->account->paymentMode == 2)
									<input disabled class="form-control" value="Full Payment">
								@else
									<input disabled class="form-control" value="Partial Payment">
								@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Amount to Pay&ensp;:</label>
								<div class="col-sm-5">
									@if($class->enrollee->account->paymentMode == 2)			
									<input  disabled value="&#8369; &ensp;&ensp;{{number_format($class->enrollee->account->balance,2)}}" class="form-control text-right">
                                    <input id="pay{{$class->id}}" type="hidden" name="amountPay" value="{{$class->enrollee->account->balance}}">
									@else
									<input disabled value="&#8369; &ensp;&ensp;{{number_format($class->enrollee->account->balance/2,2)}}" class="form-control text-right">
                                    <input id="pay{{$class->id}}" type="hidden" name="amountPay" value="{{$class->enrollee->account->balance/2}}">
									@endif
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">Payment in &#8369;&ensp;:</label>
								<div class="col-sm-5">
									<input required class="form-control text-right" type="text" id="amount{{$class->id}}" name="amount">
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
    $("#transaction").last().addClass( "active" );
    $("#collection").last().addClass( "active" );
    $("#individual_collection").last().addClass( "active" );
</script>
<script type="text/javascript">

$.validator.addMethod("regx2", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Invalid amount");

    function clicks(id){

        var pay = $('#pay'+id).val();
        console.log(pay);
        $.validator.addMethod("check", function(value, element,param) {          
            //return this.optional(element) || $('#amount'+id).val() > $('#pay'+id).val();
            if(parseInt($('#amount'+id).val()) >= parseInt($('#pay'+id).val()))
            {
                return true;
            }
        }, "Not enough gold");
        $('#collection-form'+id).validate({
            rules:{
                amount:{
                    required: true,
                    regx2: /^(?:[0-9])*(?:|\.[0-9]+)$/i,
                    space: true,
                    maxlength: 12,
                    check: true,
                },
            }
        });
    };
</script>
@endsection
