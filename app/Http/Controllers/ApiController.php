<?php namespace App\Http\Controllers;

use GuzzleHttp\Client;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use config\session;

use Illuminate\Http\Request;
use Illuminate\Http\Routes;

class ApiController extends Controller {

	public function transfersList(Request $page)
    {
        
        $client = new Client();

        $res = $client->request('GET', 'https://api.paystack.co/transfer?page='.$page.'&perPage=10',
								    ['headers' => 
								        [
								            'Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"
								        ]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        

        return view('transfers')->with('results', $results);

    }

}
