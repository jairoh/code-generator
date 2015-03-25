<?php

Class ProfileModel extends Eloquent {

	//return user information
	public function get_user_info ( $user_id ) {
		$data = DB::select( "SELECT `lastname`, `firstname`, `email_address`, `gender_id`  FROM `user` WHERE `user_id` = ?;", array( $user_id ) );
		return $data [ 0 ];
	}


	public static $update_user_rules = array( 
		'firstname' => 'required',
		'lastname' => 'required',
		'email' => 'required|email',
		'gender' => 'required|email_found'
	);

	public static $update_password_rules = array( 
		'password' => 'required|min:6',
		'password_confirmation' => 'required|min:6|password_match'
	);


	public static $errors;

	//validate before updating the profile
	public static function update_user_validate ( $data ) {

		//validate
		$messages = array(
			'email_found' => 'Email address already in use.'
		);
		Validator::extend('email_found', 'ProfileModel@email_found');
		$validation = Validator::make( $data, static::$update_user_rules, $messages );

		if ( $validation->passes() ) return true;

		static::$errors = $validation->messages();
		return false;
	}

	//validate before updating the password
	public static function update_password_validate ( $data ) {

		//validate
		$messages = array(
			'password_match' => 'Passwords do not match.'
		);
		Validator::extend( 'password_match', 'ProfileModel@password_match');

		$validation = Validator::make( $data, static::$update_password_rules, $messages );
		if ( $validation->passes() ) return true;
		static::$errors = $validation->messages();
		return false;
	}


	public function password_match () {
		return ( Input::get( 'password' ) == Input::get( 'password_confirmation' ) )? true : false;
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

	//update user account
	public function update_account ( $gender_id, $firstname, $lastname, $email, $user_id ) {
		DB::update( "UPDATE `user` SET `gender_id` = $gender_id, `firstname` = '$firstname', `lastname` = '$lastname', `email_address` = '$email' WHERE `user_id` = $user_id;" );
		return "saved";
	}

	public function update_account_pass ( $password, $user_id ) {
		DB::update( "UPDATE `user` SET `password` = SHA2( ?, 224 ) WHERE `user_id` = ?;", array( $password, $user_id ) );
		return "saved";
	}

}