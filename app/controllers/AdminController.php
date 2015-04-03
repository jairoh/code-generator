<?php


Class AdminController extends BaseController {

	private $adminModel;
	private $data;

	//constructor
	function __construct () {
		if ( Session::get( 'user_type_id' ) != 1 ) return Redirect::to( '/' );

		$this->adminModel = new AdminModel();
		$this->data [ 'page_title' ] = "Admin - University Forums";
		
		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	
	}

	//display
	function display () {
		if ( Session::get( 'user_type_id' ) != 1 ) return Redirect::to( '/' );

		$this->data [ 'easy_problems' ] = $this->adminModel->get_all_problems( 1 );
		$this->data [ 'average_problems' ] = $this->adminModel->get_all_problems( 2 );
		
		return View::make( 'admin', $this->data );
	}

	//return ajax call
	function get_orig_prob_descrip () {
		return $this->adminModel->get_orig_prob_descrip( Input::get( 'problem_id' ) );
	}

	//return ajax call
	function update_problem_descrip () {
		return $this->adminModel->update_problem_descrip( Input::get( 'problem_id' ), Input::get( 'new_problem_descrip' ) );
	}

}