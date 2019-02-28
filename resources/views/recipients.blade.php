@extends('layouts.dashboard')
@section('page_heading','Transfer Recipients')
@section('css')
    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }

        a, a:hover {
            color: white;
        }

        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

@section('section')
           
	<div class="modal fade" id="viewTransferModalForm" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>

    <div class="modal fade" id="newTransferModalForm" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>


	<table class="table table-hover">
		<thead>
			<tr>
				<th>Recipient Details</th>
				<th>Account Description</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			@foreach($results->data as $result)

				<?php

					if($result['active'] === true){
						$statusclass = 'icon-success';
					}
					else{
						$statusclass = 'icon-pending';
					}
				?>

			<tr>
				<td>{{ $result['name']." ".$result['currency']." to ".$result['details']['bank_name'] }}</td>
				<td>{{ $result['type']." ".$result['description'] }}</td>
				<td>
					<i class="fa fa-circle {{$statusclass}} fa-fw"></i>
				</td>
				<td>
					<a class="dropdown-toggle" title="Edit" href="#viewTransferModalForm" data-toggle="modal"
                       data-href="{{url('initiateTransfer/update/'.$result['id'])}}">
                        <i class="fa fa-eye fa-fw"></i> 
                    </a>
				</td>
			</tr>
					
			@endforeach
			
			<tr>
				<td colspan="3">{{ $pagination->render() }}</td>
				<td colspan="2">
                    <a href="{{url('transferRecipients/create')}}"> <button type="button" class="btn btn-primary">New Recipient</button></a>
				</td>
			</tr>

		</tbody>
	</table>

	<div class="loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="{{asset('js/ajax-crud-modal-form.js')}}"></script>
    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
            
@stop
