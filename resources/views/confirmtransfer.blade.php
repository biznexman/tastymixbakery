@extends('layouts.dashboard')
@section('page_heading','Confirm Transfer')
@section('section')
	
	<div class="col-sm-12">
		<div class="row">

			<div class="col-sm-4">
				@section ('typo4_panel_title','Transfer Details')
				@section ('typo4_panel_body')

				<strong> <p>{{ $results->data['currency']." ".number_format(($results->data['amount']/100),0)." to ".$recipientname }}</p></strong> <br>

				<address> <strong>Hello,</strong> <br>
				Paystack has sent you an OTP on your registered Mobile Number. Please provide OTP to continue <br>
				</address>

				@endsection
				@include('widgets.panel', array('header'=>true, 'as'=>'typo4'))
			</div>

		    <div class="col-lg-6">
		        <form role="form" action="confirm" name="formconfirmtransfer" id="formconfirmtransfer" method="post">

		        	<input type="hidden" name="transfercode" value="{{ $results->data['transfer_code'] }}">
		        	<input type="hidden" name="_token" value="{{ csrf_token() }}">

		            <div class="form-group">
		                <label>OTP</label>
		                <input class="form-control" placeholder="OTP" name="otp">
		            </div>
		            <p class="text-warning">You will be charged NGN 50 for this transfer.</p><br>
		            <button type="submit" class="btn btn-default">Complete Transfer</button>
		        </form>
		    </div>
		</div>
		</div>

@stop
