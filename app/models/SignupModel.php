<?php

Class SignupModel extends Eloquent {

	public static $signup_user_rules = array( 
		'Firstname' => 'required',
		'Lastname' => 'required',
		'Email' => 'required|email_found',
		'Password' => 'required|min:6',
		'Password_confirmation' => 'required|min:6|password_match',
		'Gender' => 'required'
	); 
	public static $errors;

	//validate before saving the user in
	public static function signup_user_validate ( $data ) {

		//validate
		$messages = array(
			'email_found' => 'Email address already in use.',
			'password_match' => 'Passwords do not match.'
		);
		Validator::extend('email_found', 'SignupModel@email_found');
		Validator::extend( 'password_match', 'SignupModel@password_match');
		$validation = Validator::make( $data, static::$signup_user_rules, $messages );

		if ( $validation->passes() ) return true;

		static::$errors = $validation->messages();
		return false;
	}

	public function password_match () {
		return ( Input::get( 'Password' ) == Input::get( 'Password_confirmation' ) )? true : false;
	}

	//extended validation function
	public function email_found( $field, $password, $params )
    {
        return ( $this->email_in_use( Input::get( 'Email' ) ) )? false : true;
    }

	//returns the id of the user
	public function email_in_use ( $email ) {
		$data = DB::select( "SELECT `user_id` FROM `user` WHERE `email_address` = ?;", array( $email ) );
		return count( $data )? true : false;
	}

	//save user account
	public function save_account ( $gender_id, $firstname, $lastname, $email, $password ) {
		DB::insert( "INSERT INTO `user` VALUES ( NULL, ?, ?, ?, ?, SHA2( ?, 224 ), 2 );", array( $gender_id, $firstname, $lastname, $email, $password ) );
	}

}