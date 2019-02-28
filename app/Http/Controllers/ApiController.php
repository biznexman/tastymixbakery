<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use config\session;

use Illuminate\Http\Request;
use Illuminate\Http\Routes;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller {

	public function transfersList(Request $page)
    {
        
        $client = new Client();

        $page = LengthAwarePaginator::resolveCurrentPage();

        $res = $client->request('GET', 'https://api.paystack.co/transfer?page='.$page.'&perPage=5',
								    ['headers' => 
								        ['Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        //echo $results->meta['total']; exit;
        //echo count($results->data); exit;

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']),
										        $results->meta['total'], //count as in 1st parameter
										        5, //items per page
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

            return view('newTransferForm')->with('results',$results);

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

		$this->transfersList();
        
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

    public function transferRecipientsList(Request $request)
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

	        echo 1; exit;

	        $this->transferRecipientsList();
        }
        
    }

    public function transactions(Request $request)
    {

        return view('transactions');
        
    }

    public function balancehistory(Request $request)
    {

        return view('balancehistory');
        
    }


}
