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

Route::group( array( 'prefix' => '/' ), function () {
	Route::get( '/', 'HomeController@direction' );
	Route::get( '/home', 'HomeController@font_page' );

	Route::get( '/demo', 'DemoController@display' );

	Route::group( array( 'prefix' => 'admin' ), function () {
		Route::get( '/', 'AdminController@display' );
		Route::post( 'get_orig_prob_descrip', 'AdminController@get_orig_prob_descrip' );
		Route::post( 'update_problem_descrip', 'AdminController@update_problem_descrip' );
	} );

	Route::get( 'req', function () {
		echo "<pre>";
		print_r( Session::get( 'problem_requirements' ) );
	} );

	//login
	Route::group( array( 'prefix' => 'login' ), function () {
		Route::get( '/', 'LoginController@display' );
		
		Route::post( 'do_login', 'LoginController@do_login' );
		Route::post( 'do_signup', 'LoginController@do_signup' );
	} );

	Route::group( array( 'prefix' => 'category' ), function () {
		Route::get( '/', 'CategoryController@display' );
	} );

	//round
	Route::group( array( 'prefix' => 'round' ), function () {

		//display round
		Route::get( '/{problem_category_id}/{level}', 'RoundController@display' )
		->where( array( 'category_id' => '[0-9]+', 'level' => '[0-9]+' ) );

		//check if the requirements have been met
		Route::post( 'check_problem_requirements_met', 'RoundController@check_problem_requirements_met' );

		Route::post( 'check_if_problem_at_hand_exists', 'RoundController@check_if_problem_at_hand_exists' );
		Route::post( 'insert_problem_at_hand', 'RoundController@insert_problem_at_hand' );
		Route::post( 'add_attempts_problem_at_hand', 'RoundController@add_attempts_problem_at_hand' );

		Route::post( 'get_problem_at_hand_status_id', 'RoundController@get_problem_at_hand_status_id' );
		Route::post( 'get_problem_no_attempts', 'RoundController@get_problem_no_attempts' );

		//get problem category id and level
		Route::post( 'get_problem_info', 'RoundController@get_problem_info' );

	} );

	Route::group( array( 'prefix' => 'profile' ), function () {

		Route::get( '/', 'ProfileController@display' );
		Route::post( 'do_profile_update', 'ProfileController@do_profile_update' );
		Route::post( 'do_password_update', 'ProfileController@do_password_update' );
		Route::get( '/{user_id}', 'ProfileController@display' )
		->where( array( 'user_id' => '[0-9]+' ) );

	} );

	Route::get( 'ranking', 'RankingController@display' );
	Route::get( 'ranking/{date}', 'RankingController@display' )
	->where( array( 'date' => '[0-9]{4}-[0-9]{2}-[0-9]{2}' ) );

	Route::get( 'logout', function () {
		Session::flush();
		return Redirect::to( '/home' );
	} );

} );
