<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', [
    //'middleware' => 'auth',
    'uses' => 'ApiController@paystackBalance'
]);

Route::get('/transactions', [
    //'middleware' => 'auth',
    'uses' => 'ApiController@transactions'
]);

Route::get('/balancehistory', [
    //'middleware' => 'auth',
    'uses' => 'ApiController@balancehistory'
]);

Route::group(['prefix' => 'initiateTransfer'], function () {
    Route::get('/', 'Crud5Controller@index');
    Route::match(['get'], 'show', 'ApiController@transfersList');
    Route::match(['get', 'post'], 'create', 'ApiController@initiateTransfer');
    Route::match(['post'], 'confirm', 'ApiController@finalizeTransfer');
    Route::match(['get'], 'update/{id}', 'ApiController@transferdetails');
});

Route::group(['prefix' => 'transferRecipients'], function () {
    Route::get('/', 'Crud5Controller@index');
    Route::match(['get'], 'show', 'ApiController@transferRecipientsList');
    Route::match(['get', 'post'], 'create', 'ApiController@createTransferRecipient');
    Route::match(['post'], 'confirm', 'ApiController@finalizeTransfer');
    Route::match(['get'], 'update/{id}', 'ApiController@transferdetails');
});


Route::group(['prefix' => 'transactions'], function () {
    Route::get('/', 'Crud5Controller@index');
    Route::match(['get'], 'show', 'ApiController@transactionsList');
    Route::match(['get', 'post'], 'create', 'ApiController@initiateTransaction');
    Route::match(['post'], 'confirm', 'ApiController@finalizeTransfer');
    Route::match(['get'], 'update/{id}', 'ApiController@transactionDetails');
});





Route::get('/newsupplier', function()
{
	return View::make('newsupplier');
});

Route::get('/viewsuppliers', function()
{
	return View::make('viewsuppliers');
});

Route::get('/payments', [
    //'middleware' => 'auth',
    'uses' => 'HomeController@payments'
]);

Route::get('/bills', [
    //'middleware' => 'auth',
    'uses' => 'HomeController@bills'
]);

Route::get('/pendingpayments', function()
{
	return View::make('pendingpayments');
});

Route::get('/flaggedreconciliation', function()
{
	return View::make('flaggedreconciliation');
});

Route::get('/onetimepayment', function()
{
	return View::make('onetimepayment');
});








Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/documentation', function()
{
	return View::make('documentation');
});