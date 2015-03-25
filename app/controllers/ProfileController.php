<?php


Class ProfileController extends BaseController {

	private $profileModel;
	private $categoryModel;

	//constructor
	function __construct () {
		$this->profileModel = new ProfileModel();
		$this->categoryModel = new CategoryModel();
		$this->data [ 'page_title' ] = "Profile - University Forums";
		
		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	}

	//display
	function display ( $user_id = null ) {
		if ( ! $user_id ) {
			if ( ! Session::get( 'user_id' ) ) return Redirect::to( '/' );

			$this->data [ 'user_info' ] = $this->profileModel->get_user_info ( Session::get( 'user_id' ) );
			$this->data [ 'problems_available' ] = $this->categoryModel->get_problems_available( Session::get( 'user_id' ) );

			return View::make( 'profile', $this->data );
		
		} else {
			
		}

	}


	//update user profile
	function do_profile_update () {

		if ( ! $this->profileModel->update_user_validate( Input::all() ) ) {
			
			//return errors
			echo '<div class="alert alert-danger" role="alert">' .  
					ProfileModel::$errors->first( 'lastname', '<span class="error_text" >:message</span>' ) . "" . 
					ProfileModel::$errors->first( 'firstname', '<span class="error_text" >:message</span>' ) . "" .
	 				ProfileModel::$errors->first( 'email', '<span class="error_text" >:message</span>' ) . "" .
					ProfileModel::$errors->first( 'gender', '<span class="error_text" >:message</span>' ) . 
				"</div>";

		} else {
			echo $this->profileModel->update_account ( Input::get( 'gender' ), Input::get( 'firstname' ), Input::get( 'lastname' ), 
				Input::get( 'email' ), Session::get( 'user_id' ) );
		}
	}

	//update user password
	function do_password_update () {
		if ( ! $this->profileModel->update_password_validate( Input::all() ) ) {
			//return errors
			echo '<div class="alert alert-danger" role="alert">' .  
					ProfileModel::$errors->first( 'password', '<span class="error_text" >:message</span>' ) . "" .
					ProfileModel::$errors->first( 'password_confirmation', '<span class="error_text" >:message</span>' ) . 
				"</div>";
		} else {
			return $this->profileModel->update_account_pass ( Input::get( 'password' ), Session::get( 'user_id' ) );
		}
	}

}