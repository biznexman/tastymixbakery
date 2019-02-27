<?php namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}


	public function bills(Request $billssFilter)
	{
		
		if($billssFilter->input('supplierid') != '' && $billssFilter->input('billno') != '' && $billssFilter->input('datepicker') != ''){

				$bills = DB::select('SELECT b.*,p.paymentamount,
									case when b.billamount > p.paymentamount then "partpaid"
									when b.billamount = p.paymentamount then "paid"
									when p.paymentamount = 0 or p.paymentamount is null then "unpaid"
									end status, s.suppliername
									FROM (select * from bills where billno = "'.$billssFilter->input('billno').'" and date(created_at) = "'.date('Y-m-d',$billssFilter->input('datepicker')).'") b
									left join
									(SELECT billno, sum(paymentamount) paymentamount from payments group by 1) p 
									on b.billno=p.billno
									left join (select * from suppliers where supplierid = "'.$billssFilter->input('supplierid').'") s
									on b.supplierid=s.supplierid
									order by 1');
			
		}
		elseif($billssFilter->input('supplierid') != '' && $billssFilter->input('billno') != '' && $billssFilter->input('datepicker') == ''){
			
		
		}
		elseif($billssFilter->input('supplierid') != '' && $billssFilter->input('billno') == '' && $billssFilter->input('datepicker') == ''){

		}
		elseif($billssFilter->input('supplierid') == '' && $billssFilter->input('billno') != '' && $billssFilter->input('datepicker') != ''){

		}
		elseif($billssFilter->input('supplierid') == '' && $billssFilter->input('billno') != '' && $billssFilter->input('datepicker') == ''){

		}
		elseif($billssFilter->input('supplierid') == '' && $billssFilter->input('billno') == '' && $billssFilter->input('datepicker') != ''){

		}
		elseif($billssFilter->input('supplierid') == '' && $billssFilter->input('billno') == '' && $billssFilter->input('datepicker') == ''){

			$bills = DB::select('SELECT b.*,p.paymentamount,
								case when b.billamount > p.paymentamount then "partpaid"
								when b.billamount = p.paymentamount then "paid"
								when p.paymentamount = 0 or p.paymentamount is null then "unpaid"
								end status, s.suppliername
								FROM bills b
								left join
								(SELECT billno, sum(paymentamount) paymentamount from payments group by 1) p 
								on b.billno=p.billno
								left join suppliers s
								on b.supplierid=s.supplierid
								order by 1');

		}

		$payments = DB::select('SELECT p.paymentno, b.billno, p.paymentref, p.status, p.paymentcardno,pm.paymentmethodtype, date_format(p.created_at,"%d-%m-%Y") "paymentdate"
								FROM payments p, paymentmethods pm, bills b
								where p.paymentcardno=pm.paymentcardno
								and p.billno=b.billno');

		return view('bills')->with('bills', $bills)
							->with('payments', $payments);

	}


	public function transfers(Request $transfersinfo)
	{

		return view('transfers');

	}



	public function payments(Request $billinfo)
	{

		return view('payments');

	}

}
