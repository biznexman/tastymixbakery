@extends('layouts.dashboard')
@section('page_heading','New Transfer')
@section('section')
	
	<div class="col-sm-12">
		<div class="row">
		    <div class="col-lg-6">
		        <form role="form" action="create" name="forminitiatetransfer" id="forminitiatetransfer" method="post">

		        	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		            <div class="form-group">
		                <label>Recipient</label>
		                <select class="form-control" name="recipientcode">
		                    <option></option>
		                    @foreach($results->data as $result)
		                    	<option value="{{ $result['recipient_code'] }}">{{ $result['name'] }}</option>
		                    @endforeach
		                </select>
		                <a href="{{url('transferRecipients/create')}}"> or add new Transfer Recipient</a>
		            </div>


		            <label>Amount</label>
		            <div class="form-group input-group">
                        <span class="input-group-addon">N</span>
                        <input type="text" name="amount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="primary_device" class="form-control">
                        <span class="input-group-addon">.00</span>
                    </div>

		            <div class="form-group">
		                <label>Transfer Note</label>
		                <input class="form-control" placeholder="Transfer Note" name="transfernote">
		            </div>

		            <div class="form-group">
		                <label>Transfer Reference</label>
		                <input class="form-control" placeholder="Transfer Reference" name="transferref">
		            </div>
		            <p class="text-warning">You will be charged NGN 50 for this transfer.</p><br>
		            <button type="submit" class="btn btn-default">Start Transfer</button>
		        </form>
		    </div>
		</div>
		</div>

@stop
