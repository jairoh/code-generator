<?php


Class CategoryController extends BaseController {

	private $categoryModel;

	//constructor
	function __construct () {
		if ( ! Session::get( 'user_id' ) ) Redirect::to( '/' );

		$this->categoryModel = new CategoryModel();
		$this->data [ 'page_title' ] = "Category - University Forums";
		
		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	}

	//display
	function display () {
		$this->data [ 'problems_available' ] = $this->categoryModel->get_problems_available( Session::get( 'user_id' ) );

		/*echo "<pre>";
		print_r( $this->data [ 'problems_available' ] );
		die();*/

		//show view
		return View::make( 'category', $this->data );
	}


}