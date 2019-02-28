@extends('layouts.dashboard')
@section('page_heading','New Recipient')
@section('section')
	
	<div class="col-sm-12">
		<div class="row">
		    <div class="col-lg-6">
		        <form role="form" action="create" name="forminitiatetransfer" id="forminitiatetransfer" method="post">

		        	<input type="hidden" name="_token" value="{{ csrf_token() }}">


		        	<div class="form-group">
		                <label>Recipient Name</label>
		                <input class="form-control" placeholder="Full Name" name="recipientname">
		            </div>

		            <div class="form-group">
		                <label>Account Type</label>
		                <input class="form-control" readonly="readonly" placeholder="Account Type" name="accounttype" value="nuban">
		            </div>

		            <div class="form-group">
		                <label>Currency</label>
		                <input class="form-control" readonly="readonly" placeholder="Account Type" name="currency" value="NGN">
		            </div>

		            <div class="form-group">
		                <label>Bank</label>
		                <select class="form-control" name="bank">
		                    <option></option>
		                    @foreach($results->data as $result)
		                    	<option value="{{ $result['code'] }}">{{ $result['name'] }}</option>
		                    @endforeach
		                </select>
		            </div>

		            <label>Account Number</label>
		            <div class="form-group input-group">
                        <input type="text" name="accountnumber" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="primary_device" class="form-control" value="0000000000">
                    </div>

		            <p class="text-warning">Account Number field has been populated with provisioned Test Account</p><br>
		            <button type="submit" class="btn btn-default">Create Recipient</button>
		        </form>
		    </div>
		</div>
		</div>

@stop
