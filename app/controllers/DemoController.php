<?php

class DemoController extends BaseController {

	private $demoModel;
	private $data;

	//constructor
	function __construct () {
		$this->data [ 'page_title' ] = "Demo - Code Fragment Generator";
		
		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	}

	//display login
	function display () {
		return View::make( 'demo', $this->data );
	}


}
