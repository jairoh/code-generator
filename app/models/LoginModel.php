<?php

Class LoginModel extends Eloquent {

	public static $login_user_rules = array( 
		'email' => 'required',
		'password' => 'required|user_found'
	); 
	public static $errors;

	//validate before logging the user in
	public static function login_user_validate ( $data ) {
		

		//validate
		$messages = array(
			'user_found' => 'Do I know you?'
		);
		Validator::extend('user_found', 'LoginModel@user_found');
		$validation = Validator::make( $data, static::$login_user_rules, $messages );

		if ( $validation->passes() ) return true;

		static::$errors = $validation->messages();
		return false;
	}

	//extended validation function
	public function user_found( $field, $password, $params)
    {
        return ( count( $this->get_user_info( Input::get( 'email' ), $password ) ) != 0 )? true : false;
    }

	//returns the id of the user
	public function get_user_info ( $email, $password ) {
		$data = DB::select( "SELECT `user_id`, `firstname`, `lastname`, `user_type_id` FROM `user` WHERE `email_address` = ? AND `password` = SHA2( '$password', 224 );", array( $email ) );
		return count( $data )? $data [ 0 ] : array();
	}

}