<?php

class LoginController extends BaseController {

	private $loginModel;
	private $signupModel;
	private $data;

	//constructor
	function __construct () {
		$this->loginModel = new LoginModel();
		$this->signupModel = new SignupModel();
		$this->data [ 'page_title' ] = "Login - Code Fragment Generator";
		
		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	}

	//display login
	function display () {
		return ( Session::get( 'user_id' ) )? Redirect::to( '/' ) : View::make( 'login', $this->data );
	}


	//do login
	function do_login () {
		//validate the inputs 
		if ( ! $this->loginModel->login_user_validate( Input::all() ) ) {
			return Redirect::back()->withInput()->withErrors( LoginModel::$errors );
		}

		//get the user info
		$user_info = $this->loginModel->get_user_info ( Input::get( 'email' ), Input::get( 'password' ) );

		//store the user info in the session
		Session::put( 'user_id', $user_info->user_id );
		Session::put( 'firstname', $user_info->firstname );
		Session::put( 'lastname', $user_info->lastname );

		//redirect to home page
		return Redirect::to( 'category' );
	}


	//do signup
	function do_signup () {
		//validate the inputs 
		if ( ! $this->signupModel->signup_user_validate( Input::all() ) ) {
			return Redirect::back()->withInput()->withErrors( SignupModel::$errors );
		}
		
		$this->signupModel->save_account ( Input::get( 'Gender' ), Input::get( 'Firstname' ), Input::get( 'Lastname' ), Input::get( 'Email' ), Input::get( 'password' ) );

		return Redirect::to('/login')->with('reg_message', 'Registration successful!');
	}

}
