<?php

class RankingController extends BaseController {

	private $rankingModel;

	//constructor
	function __construct () {
		$this->rankingModel = new RankingModel();

		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
		$this->data [ 'page_title' ] = "Code Fragment Generator - User Ranking";
	}
	
	//display
	function display ( $date = null ) {
		if ( ! Session::get( 'user_id' ) ) return Redirect::to( '/' );

		$this->data [ 'date' ] = ( $date != null )? "'$date'" : "";
		$this->data [ 'easy_level_top_students' ] = $this->rankingModel->get_all_problems_with_leading_students ( 1, $this->data [ 'date' ] );
		$this->data [ 'average_level_top_students' ] = $this->rankingModel->get_all_problems_with_leading_students ( 2, $this->data [ 'date' ] );
		$this->data [ 'dificult_level_top_students' ] = $this->rankingModel->get_all_problems_with_leading_students ( 3, $this->data [ 'date' ] );
		
		
		/*echo "<pre>";
		print_r( $this->data [ 'easy_level_top_students' ] );
		die();*/

		return View::make( 'ranking', $this->data );
	}
}
