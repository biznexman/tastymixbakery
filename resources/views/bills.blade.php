@extends('layouts.dashboard')
@section('page_heading','Filters')
@section('section')
           

    <div class="row">
    	<form role="form" action="manageProjects" method="get" id="projectsFilter" name="projectsFilter">

		    <input type="hidden" name="_token" value="{{ csrf_token() }}">

		    <div class="col-sm-3">
				@section ('grid10_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Supplier ID</label>
			            <input id="supplierid" name="supplierid" class="form-control">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid10'))
			</div>


			<div class="col-sm-3">
				@section ('grid11_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Bill No.</label>
			            <input id="billno" name="billno" class="form-control">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid11'))
			</div>

			<div class="col-sm-3">
				@section ('grid9_panel_body')
				<div class="text-center">
					<div class="form-group">
			            <label>Date</label>
			            <input type="text" id="datepicker" name="datepicker" class="form-control" placeholder="yyyy-mm-dd">
			        </div>
				</div>
				@endsection
				@include('widgets.panel', array('controls'=> true, 'as'=> 'grid9'))
			</div>

			

			<div class="col-sm-3">
				<div class="text-center">
					<div class="form-group">
						<br><br><br><br>
			            <button id="sort" name="sort" type="button" class="btn btn-primary">Sort</button>
			        </div>
				</div>
			</div>

		</form>
    </div>
	
	<div class="row">
		<div class="col-sm-6">
			@section ('htable_panel_title','Bills')
			@section ('htable_panel_body')
			

			<table class="table table-hover">
				<thead>
					<tr>
						<th>Bill No</th>
						<th>Supplier</th>
						<th>Description</th>
						<th>Bill Amount</th>
						<th>Paid Amount</th>
						<th>Status</th>
						<th>Bill Created</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php
			        	$x=0;
			        ?>

					@foreach($bills as $bill)

					<?php
			        	$x++;
						$viewModal = 'viewModal'.$x;
			        ?>

					<tr>
						<td>{{ $bill->billno }}</td>
						<td>{{ $bill->suppliername }}</td>
						<td>{{ $bill->description }}</td>
						<td>{{ $bill->billamount }}</td>
						<td>{{ $bill->paymentamount }}</td>
						<td>{{ $bill->status }}</td>
						<td nowrap="nowrap">{{ $bill->created_at }}</td>
						<td>
							<a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#{{$viewModal}}">
			                    <i class="fa fa-eye fa-fw"></i> 
			                </a>
						</td>
						<td>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                    <i class="fa fa-pencil fa-fw"></i>
			                </a>
						</td>
						<td>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                    <i class="fa fa-trash-o fa-fw"></i>
			                </a>
						</td>
					</tr>


					<form role="form" action="payments" name="payments" id="payments" method="get">
						<!-- View Large Modal -->
						<div class="modal fade" id="{{$viewModal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">Bill Number {{ $bill->billno }}
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel"></h4>
									</div>
									<div class="modal-body">
										<div class="text-left">
											<strong>Supplier: </strong>{{ $bill->suppliername }}
										</div>
										<div class="text-left">
											<strong>Description: </strong>{{ $bill->description }}
										</div>
										<div class="text-left">
											<strong>Bill Amount: </strong>{{ $bill->billamount }}
										</div>
										<div class="text-left">
											<strong>Paid Amount: </strong>{{ $bill->paymentamount }}
										</div>
										<div class="text-left">
											<strong>Status: </strong>{{ $bill->status }}
										</div>

									</div>

										<div class="modal-header">Payment History</div>

									<div class="modal-body">

										<div class="div-table">
											<div class="div-table-row">
												<div class="div-table-colhead-narrow" align="center">PaymentNo</div>
												<div  class="div-table-colhead-narrow">PaymentRef</div>
												<div  class="div-table-colhead-wide">CardNo</div>
												<div  class="div-table-colhead-narrow">PaymentType</div>
												<div  class="div-table-colhead-narrow">PaymentDate</div>
											</div>

											@foreach($payments as $payment)

												@if ($payment->billno == $bill->billno)
													<div class="div-table-row">
														<div class="div-table-col-narrow" align="center">{{ $payment->paymentno }}</div>
														<div class="div-table-col-narrow">{{ $payment->paymentref }}</div>
														<div class="div-table-col-wide">{{ $payment->paymentcardno }}</div>
														<div class="div-table-col-narrow">{{ $payment->paymentmethodtype }}</div>
														<div class="div-table-col-narrow">{{ $payment->paymentdate }}</div>
													</div>
												@endif

											@endforeach

										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success btn-primary"><i class="fa fa-dollar"></i> Pay</button> 
										<button type="button" class="btn btn-warning btn-primary"><i class="fa fa-flag"></i> Flag</button>
									</div>
								</div>
							</div>
						</div>
					</form>
							
					@endforeach

				</tbody>
			</table>

			@endsection
			@include('widgets.panel', array('header'=>true, 'as'=>'htable'))
		</div>
	</div>
            
@stop
