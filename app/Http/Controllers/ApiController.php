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
								        [
								            'Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"
								        ]
								    ]
							    );

        $results = (object)json_decode($res->getBody(), true);

        //echo $results->meta['total']; exit;
        //echo count($results->data); exit;

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']), //a fake range of total items, you can use range(1, count($collection))
																        $results->meta['total'], //count as in 1st parameter
																        5, //items per page
																        [$page], //resolve the path
																    	["path"=>LengthAwarePaginator::resolveCurrentPath()]
																    );

		//$pagination->setItems($results);
		//$pagination->setPath('/tastymixbakery/public/transfers?page='.$page);
		var_dump($pagination); exit;

        return view('transfers')->with('results', $results)
        						->with('pagination', $pagination);

    }

}
