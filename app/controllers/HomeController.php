<?php

class HomeController extends BaseController {

	private $homeModel;
	

	//constructor
	function __construct () {
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
		$this->data [ 'page_title' ] = "Code Fragment Generator";
	}
	
	function direction () {
		return ( Session::get( 'user_id' ) )? Redirect::to( '/category' ) : View::make( 'login', $this->data );
	}

}
