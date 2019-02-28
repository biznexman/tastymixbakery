<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use config\session;

use Illuminate\Http\Request;
use Illuminate\Http\Routes;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Crud5Controller extends Controller
{
    public function index(Request $request)
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

		$pagination = new LengthAwarePaginator(range($page,$results->meta['total']),
										        $results->meta['total'], //count as in 1st parameter
										        5, //items per page
										        [$page], //resolve the path
										    	["path"=>LengthAwarePaginator::resolveCurrentPath()]);

		//$pagination->setItems($results);
		//$pagination->setPath('/tastymixbakery/public/transfers?page='.$page);
		//var_dump($pagination); exit;

        return view('crud_5.ajax')->with('results', $results->data)
        						->with('pagination', $pagination);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get'))
            return view('crud_5.form');
        else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors()
                ]);
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->save();
            return response()->json([
                'fail' => false,
                'redirect_url' => url('laravel-crud-search-sort-ajax-modal-form')
            ]);
        }
    }

    public function delete($id)
    {
        Customer::destroy($id);
        return redirect('/laravel-crud-search-sort-ajax-modal-form');
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')){
            $client = new Client();

	        $page = LengthAwarePaginator::resolveCurrentPage();

	        $res = $client->request('GET', 'https://api.paystack.co/transfer/'.$id,
									    ['headers' => 
									        [
									            'Authorization' => "Bearer sk_test_b7eb5f49afc897786bb058635dce32dcb5f7d128"
									        ]
									    ]
								    );

	        $results = (object)json_decode($res->getBody(), true);

	        //var_dump($results->data['amount']); exit;
	        return view('crud_5.form')->with('results', $results->data);
        }else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors()
                ]);
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->save();
            return response()->json([
                'fail' => false,
                'redirect_url' => url('laravel-crud-search-sort-ajax-modal-form')
            ]);
        }
    }
}