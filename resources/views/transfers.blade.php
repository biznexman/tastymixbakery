@extends('layouts.dashboard')
@section('page_heading','Transfers')
@section('section')
           
<!--<div class="form-group row add">
	<div class="col-md-8">
	    <input type="text" class="form-control" id="name" name="name"
	        placeholder="Enter some name" required>
	    <p class="error text-center alert alert-danger hidden"></p>
	</div>
	<div class="col-md-4">
	    <button class="btn btn-primary" type="submit" id="add">
	        <span class="glyphicon glyphicon-plus"></span> New Transfer
	    </button>
	</div>
</div>-->


	<table class="table table-hover">
		<thead>
			<tr>
				<th>Transfer Details</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Date</th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			@foreach($results->data as $result)

				<?php

					if($result['status']=='success'){
						$statusclass = 'icon-success';
					}
					elseif($result['status']=='abandoned'){
						$statusclass = 'icon-abandoned';
					}
					elseif($result['status']=='otp'){
						$statusclass = 'icon-pending';
					}
				?>

			<tr>
				<td>{{ $result['currency']." ".number_format(($result['amount']/100),0)." to ".$result['recipient']['name'] }}</td>
				<td>{{ $result['reason'] }}</td>
				<td>
					<a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#viewModal">
	                    <i class="fa fa-circle {{$statusclass}} fa-fw"></i> 
	                </a>
				</td>
				<td>{{ date('D jS, M Y hA', strtotime($result['createdAt'])) }}</td>
				<td>
					<a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#viewModal">
	                    <i class="fa fa-eye fa-fw"></i> 
	                </a>
				</td>
			</tr>
					
			@endforeach
			
			<tr>
				<td colspan="4"></td>
				<td colspan="2"></br>
					<a href="{{ url ('newProject') }}"> <button type="button" class="btn btn-primary">New Transfer</button></a>
				</td>
			</tr>

		</tbody>
	</table>
            
@stop
