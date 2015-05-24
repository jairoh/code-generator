<?php

class RoundController extends BaseController {

	private $roundModel;

	//constructor
	function __construct () {
		$this->roundModel = new RoundModel();
		$this->data [ 'page_title' ] = "Round - Code Fragment Generator";

		//echo "<pre>";
		//print_r( $_SERVER );die();

		//for js/css/img path
		$http_host = $_SERVER [ 'HTTP_HOST' ];
		$this->data [ 'root_path' ] =  ( ! preg_match( '/^(127.0.0.1)|(172.16.52.249)|(192.168.8.100)$/', $http_host) )? '/' : "http://$http_host/code-generator/public/" ;
	

		//clear cache on the browser side
		header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}

	//display round
	public function display ( $problem_category_id = 1, $level = 1 ) {
		if ( ! Session::get( 'user_id' ) ) return Redirect::to( '/' );
		

		//redirect if the problem is not available
		if ( ! ( $problem_category_id == 1 && $level == 1 ) )
			if ( ! $this->roundModel->if_current_problem_available ( $problem_category_id, $level, Session::get( 'user_id' ), 2 ) ) return Redirect::to( '/' );

		$this->data [ 'problem_category_id' ] = $problem_category_id;
		$this->data [ 'level' ] = $level;
		if ( $problem_category_id == 1 ) $this->data [ 'problem_category_descrp' ] = "Easy";
		else if ( $problem_category_id == 2 ) $this->data [ 'problem_category_descrp' ] = "Average";
		else if ( $problem_category_id == 3 ) $this->data [ 'problem_category_descrp' ] = "Difficult";

		//get problem id
		$problem_id = $this->roundModel->getProblemId ( $problem_category_id, $level );

		//check if problem exists
		//throw 404 error if the problem isn't found
		if ( is_null( $problem_id ) ) App::abort(404);

		//get problem info
		$this->data [ 'problem_description' ] = $this->roundModel->getProblemDescription( $problem_id );

		//put the problem requirements into session for checking
		Session::put( 'problem_requirements', array(
			'tag_requirements' => $this->roundModel->getProblemTagRequirements( $problem_id ),
			'expected_structure' => $this->roundModel->getProblemExpectedStructure( $problem_id ),
			'expected_output' => $this->roundModel->getProblemExpectedOutput( $problem_id )
		) );

		$this->data [ 'user_id' ] = Session::get( 'user_id' );
		$this->data [ 'problem_id' ] = $problem_id;
		$this->data [ 'expected_structure' ] = $this->roundModel->getProblemExpectedStructure( $problem_id );
		$this->data [ 'expected_output' ] = $this->roundModel->getProblemExpectedOutput( $problem_id );
		
		return View::make( 'round', $this->data );
	}//end display


	//check if the requirements have been met
	public function check_problem_requirements_met () {
		$this->roundModel->ifRequirementsMet ( Input::get( 'user_input' ) );
	}

	//check if the problem exists
	public function check_if_problem_at_hand_exists () {
		$this->roundModel->checkIfProblemAtHandExists( Input::get( 'problem_id' ), Input::get( 'user_id' ) );
	}

	//insert problem at hand
	public function insert_problem_at_hand ( ) {
		$this->roundModel->insertProblemAtHand( Input::get( 'problem_id' ), Input::get( 'user_id' ), Input::get( 'problem_at_hand_status_id' ) );
	}

	//add attempts to the problem at hand 
	public function add_attempts_problem_at_hand () {
		$this->roundModel->addAttemptsProblemAtHand( Input::get( 'problem_id' ), Input::get( 'user_id' ), Input::get( 'problem_at_hand_status_id' ) );
	}

	//returns problem at hand status id
	public function get_problem_at_hand_status_id () {
		return $this->roundModel->get_problem_at_hand_status_id( Input::get( 'problem_id' ), Input::get( 'user_id' ) );
	}

	//return problem at hand no of attempts
	public function get_problem_no_attempts () {
		return $this->roundModel->get_problem_no_attempts( Input::get( 'problem_id' ), Input::get( 'user_id' ) );
	}

	//return the problem info
	public function get_problem_info () {
		return $this->roundModel->get_problem_info( Input::get( 'db_column_name' ) ,Input::get( 'problem_id' ) );
	}

}
