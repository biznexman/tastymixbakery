<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use config\session;

use Illuminate\Http\Request;
use Illuminate\Http\Routes;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller {

	public function __construct()
	{
	    //echo auth()->user(); exit;
	    //$this->middleware('auth');
	}

	public function home()
    {


    	$client = new Client();

        $res = $client->request('GET', 'https://api.paystack.co/balance',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        $transfers = $this->getTransfers();
        $recipients = $this->getRecipients();

        return view('home')->with('results',$results)
        				->with('transfers',$transfers)
        				->with('recipients',$recipients);
     
    }

    public function getBalance()
    {

    	$client = new Client();

        $res = $client->request('GET', 'https://api.paystack.co/balance',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        return $results;
     
    }

    public function getTransfers()
    {

    	$cntsuccess = 0;
    	$cntabandoned = 0;
    	$cntotp = 0;

    	$client = new Client();

        $res = $client->request('GET', 'https://api.paystack.co/transfer',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        foreach ($results->data as $result) {
        	if($result['status']=='success'){
				$cntsuccess++;
			}
			elseif($result['status']=='abandoned'){
				$cntabandoned++;
			}
			elseif($result['status']=='otp'){
				$cntotp++;
			}
        }

        return [$cntsuccess,$cntabandoned,$cntotp];
     
    }

    public function getRecipients()
    {

    	$client = new Client();

        $res = $client->request('GET', 'https://api.paystack.co/transferrecipient',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        return $results;
     
    }

    // -----------------------------------------------------------------------------------------------------------------

	public function transfersList()
    {
        
        $client = new Client();

        $page = LengthAwarePaginator::resolveCurrentPage();

        $res = $client->request('GET', 'https://api.paystack.co/transfer?page='.$page.'&perPage=10',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        //echo $results->meta['total']; exit;
        //echo count($results->data); exit;

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']),
										        $results->meta['total'], //count as in 1st parameter
										        10, //items per page
										        [$page], //resolve the path
										    	["path"=>LengthAwarePaginator::resolveCurrentPath()]);

		//$pagination->setItems($results);
		//$pagination->setPath('/tastymixbakery/public/transfers?page='.$page);
		//var_dump($pagination); exit;

        return view('transfers')->with('results', $results)
        						->with('pagination', $pagination);

    }


    public function initiateTransfer(Request $request)
    {
        if ($request->isMethod('get')){

        	$client = new Client();

	        $res = $client->request('GET', 'https://api.paystack.co/transferrecipient',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
									    ]
								    );

	        $results = (object)json_decode($res->getBody(), true);

	        $accountdetails = $this->getBalance();

            return view('newTransferForm')->with('results',$results)
            							->with('accountdetails',$accountdetails);

        }else {

            $client = new Client();
	        $res = $client->request('POST', 'https://api.paystack.co/transfer',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"],
									    'form_params' =>
									        ['source' => "balance",
									        'amount' => $request->input('amount'),
									        'reason' => $request->input('transfernote'),
									        'recipient' => $request->input('recipientcode')]
									    ]
								    );
	        $results = (object)json_decode($res->getBody(), true);
	    	


	        $client2 = new Client();
	        $rec = $client2->request('GET', 'https://api.paystack.co/transferrecipient',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
									    ]
								    );
	        $recipients = (object)json_decode($rec->getBody(), true);

	        foreach ($recipients->data as $recipient) {
	        	if($recipient['id'] == $results->data['recipient']){
	        		$recipientname = $recipient['name'];
	        	}
	        }

			return view('confirmtransfer')->with('results', $results)
										->with('recipientname', $recipientname);
        }
        
    }


    public function finalizeTransfer(Request $request)
    {
        
        $client = new Client();
    	
        $res = $client->request('POST', 'https://api.paystack.co/transfer/finalize_transfer',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"],
								    'form_params' =>
								        ['source' => "balance",
								        'transfer_code' => $request->input('transfercode'),
								        'otp' => $request->input('otp')]
								    ]
							    );
        $results = (object)json_decode($res->getBody(), true);

		return $this->transfersList();
        
    }


    public function transferdetails(Request $request, $id)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://api.paystack.co/transfer/'.$id,
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        //var_dump($results->data['amount']); exit;
        return view('crud_5.viewtransferform')->with('results', $results->data);
    
    }

    public function transferRecipientsList()
    {
        
        $client = new Client();

        $page = LengthAwarePaginator::resolveCurrentPage();

        $res = $client->request('GET', 'https://api.paystack.co/transferrecipient?page='.$page.'&perPage=5',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']),
										        $results->meta['total'], //count as in 1st parameter
										        5, //items per page
										        [$page], //resolve the path
										    	["path"=>LengthAwarePaginator::resolveCurrentPath()]);

		//var_dump($results); exit;

        return view('recipients')->with('results', $results)
        						->with('pagination', $pagination);
        
    }

    public function createTransferRecipient(Request $request)
    {
        
        if ($request->isMethod('get')){

        	$client = new Client();

	        $res = $client->request('GET', 'https://api.paystack.co/bank',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
									    ]
								    );

	        $results = (object)json_decode($res->getBody(), true);

	        //var_dump($results); exit;

            return view('newRecipientForm')->with('results',$results);

        }else {

            $client = new Client();

	        $res = $client->request('POST', 'https://api.paystack.co/transferrecipient',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"],
									    'form_params' =>
									        ['type' => $request->input('accounttype'),
									        'name' => $request->input('recipientname'),
									        'currency' => $request->input('currency'),
									        'bank_code' => $request->input('bank'),
									    	'account_number' => $request->input('accountnumber')]
									    ]
								    );
	        $results = (object)json_decode($res->getBody(), true);

	        return $this->transferRecipientsList();
        }
        
    }

    public function transactionsList()
    {

    	$client = new Client();

        $page = LengthAwarePaginator::resolveCurrentPage();

        $res = $client->request('GET', 'https://api.paystack.co/transaction?page='.$page.'&perPage=10',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']),
										        $results->meta['total'], //count as in 1st parameter
										        10, //items per page
										        [$page], //resolve the path
										    	["path"=>LengthAwarePaginator::resolveCurrentPath()]);

		//var_dump($results); exit;

        return view('transactions')->with('results', $results)
        						->with('pagination', $pagination);
        
    }

    public function transactionDetails(Request $request, $id)
    {

        $client = new Client();
        $res = $client->request('GET', 'https://api.paystack.co/transaction/'.$id,
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        return view('crud_5.viewtransactionform')->with('results', $results->data);
    
    }

    public function initiateTransaction(Request $request)
    {
        if ($request->isMethod('get')){

        	$client = new Client();

	        $res = $client->request('GET', 'https://api.paystack.co/transferrecipient',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
									    ]
								    );

	        $results = (object)json_decode($res->getBody(), true);

	        $accountdetails = $this->getBalance();

            return view('newTransactionForm')->with('results',$results)
            							->with('accountdetails',$accountdetails);

        }else {

            $client = new Client();
	        $res = $client->request('POST', 'https://api.paystack.co/transfer',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"],
									    'form_params' =>
									        ['source' => "balance",
									        'amount' => $request->input('amount'),
									        'reason' => $request->input('transfernote'),
									        'recipient' => $request->input('recipientcode')]
									    ]
								    );
	        $results = (object)json_decode($res->getBody(), true);
	    	


	        $client2 = new Client();
	        $rec = $client2->request('GET', 'https://api.paystack.co/transferrecipient',
									    ['headers' => 
									        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
									    ]
								    );
	        $recipients = (object)json_decode($rec->getBody(), true);

	        foreach ($recipients->data as $recipient) {
	        	if($recipient['id'] == $results->data['recipient']){
	        		$recipientname = $recipient['name'];
	        	}
	        }

			return view('confirmtransfer')->with('results', $results)
										->with('recipientname', $recipientname);
        }
        
    }

    public function balancehistory(Request $request)
    {

        return view('balancehistory');
        
    }


}
