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

Route::get('/', function()
{
	return View::make('signup');
});

Route::post('/', function()
{
	$validator = Validator::make(
	    Input::all(),
	    [
	    	'email' => 'required|email',
	    	'name' => 'required|min:2',
	    	'accept' => 'accepted'
	    ]
	);

	if ($validator->fails())
	{
		return Redirect::back()
			->withInput()
			->withErrors($validator);
	} else {
		return View::make('success');
	}
});