<?php

class RoundModel extends Eloquent {

	//return the problem id
	function getProblemId ( $problem_category_id, $level ) {
		$data = DB::select( "SELECT `problem_id` FROM `problem` WHERE `problem_category_id` = ? AND `level` = ?;", array( $problem_category_id, $level ) );
		return count( $data )? $data [ 0 ]->problem_id : null;
	}

	//return the description of the problem
	function getProblemDescription ( $problem_id ) {
		$data = DB::select( "SELECT `description` FROM `problem` WHERE `problem_id` = ?;", array( $problem_id ) );
		return $data [ 0 ]->description;
	}

	//return the conditional requirements of the problem (# of tags)
	function getProblemTagRequirements ( $problem_id ) {
		$data = DB::select( "SELECT * FROM `tag_requirements` WHERE `problem_id` = ( SELECT `tag_requirements_id` FROM `problem` WHERE `problem_id` = ? );", array( $problem_id ) );
		return $data [ 0 ];
	}

	//return the expected structural pattern
	function getProblemExpectedStructure ( $problem_id ) {
		$data = DB::select( "SELECT `structure` FROM `problem` WHERE `problem_id` = ?;", array( $problem_id ) );
		return $data [ 0 ]->structure;
	}

	//return the expected output of the problem
	function getProblemExpectedOutput ( $problem_id ) {
		$data = DB::select( "SELECT `output` FROM `problem` WHERE `problem_id` = ?;", array( $problem_id ) );
		return $data [ 0 ]->output;
	}

	//check if the requirements have been met
	function ifRequirementsMet ( $input_arr ) {
		$requirements_arr = Session::get( 'problem_requirements' );

		//print_r( $requirements_arr );
		//print_r( $input_arr );


		$req_output_regex_pattern = "/" . $requirements_arr [ 'expected_output' ] . "/";
		$trimmed_user_output = preg_replace( '/^\s*\b(.+\b)\s*$/', '$1', $input_arr [ 'output' ] );

		$req_structure_pattern = "/" . $requirements_arr [ 'expected_structure' ] . "/";

		
		//check if output if matched in the regex
		if ( preg_match_all( $req_structure_pattern , $input_arr [ 'structure' ] ) && 
			preg_match_all( $req_output_regex_pattern, $trimmed_user_output ) ) echo 'true';
		else echo 'false';
	}

	//returns true if the problem at hand exists
	function checkIfProblemAtHandExists ( $problem_id, $user_id ) {
		$data = DB::select( "SELECT `problem_at_hand_id` FROM `problem_at_hand` WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_id, $user_id ) );
		echo ( count( $data ) )? true : false;
	}

	//insert new problem at hand
	function insertProblemAtHand ( $problem_id, $user_id, $problem_at_hand_status_id ) {
		return DB::insert( "INSERT INTO `problem_at_hand` VALUES( NULL, ?, ?, ?, 1, CURDATE() )", array( $problem_id, $problem_at_hand_status_id, $user_id ) );
	}

	//add attempts
	function addAttemptsProblemAtHand ( $problem_id, $user_id, $problem_at_hand_status_id ) {
		$data = DB::select( "SELECT `problem_at_hand_id`, `problem_at_hand_status_id` FROM `problem_at_hand` WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_id, $user_id ) );
		if ( count( $data ) ) {
			if ( $data [ 0 ]->problem_at_hand_status_id == 1 ) {
				DB::update( "UPDATE `problem_at_hand` SET  `problem_at_hand_status_id` = ?, `no_attempts` = `no_attempts` + 1, `last_attempt_date` = CURDATE() WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_at_hand_status_id, $problem_id, $user_id ) );
			}
		} else {
			DB::update( "UPDATE `problem_at_hand` SET  `problem_at_hand_status_id` = ?, `no_attempts` = `no_attempts` + 1, `last_attempt_date` = CURDATE() WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_at_hand_status_id, $problem_id, $user_id ) );
		}
	}

	//returns problem at hand status id
	function get_problem_at_hand_status_id ( $problem_id, $user_id ) {
		$data = DB::select( "SELECT `problem_at_hand_status_id` FROM `problem_at_hand` WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_id, $user_id ) );
		return ( count ( $data ) )? $data [ 0 ]->problem_at_hand_status_id : 1;
	}

	//return problem at hand no of attempts
	function get_problem_no_attempts ( $problem_id, $user_id ) {
		$data = DB::select( "SELECT `no_attempts` FROM `problem_at_hand` WHERE `problem_id` = ? AND `user_id` = ?;", array( $problem_id, $user_id ) );
		return ( count ( $data ) )? $data [ 0 ]->no_attempts : 0;
	}


	//return problem info
	function get_problem_info ( $db_column_name, $problem_id ) {
		$data = DB::select( "SELECT $db_column_name FROM `problem` WHERE `problem_id` = ?;", array( $problem_id ) );
		return ( count ( $data ) )? $data [ 0 ]->$db_column_name : 0;
	}

	//returns true if the current problem is available for user to use
	function if_current_problem_available ( $problem_category_id, $level, $user_id, $problem_at_hand_status_id ) {
		if ( ( $problem_category_id == 2 || $problem_category_id == 2 ) && $level == 1 ) {
			$problem_category_id--;
			$level = 6;
		}
		$data = DB::select( "SELECT `problem_at_hand_id` 

				FROM `problem_at_hand` 

				WHERE 

				`problem_id` = 
					( SELECT `problem_id` FROM `problem` WHERE `problem_category_id` = ? AND `level` = (?-1) ) 

				AND `user_id` = ? AND `problem_at_hand_status_id` = ?;", array( $problem_category_id, $level, $user_id, $problem_at_hand_status_id ) );
		return ( count( $data ) )? true : false;
	}
}
