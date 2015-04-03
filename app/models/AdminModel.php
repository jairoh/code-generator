<?php

class AdminModel extends Eloquent {
	
	//return array of all problems w/in a category
	public function get_all_problems ( $problem_category_id ) {
		return DB::select( "SELECT `problem_id`, `level`, `description`, `orig_description` FROM `problem` WHERE `problem_category_id` = ?;", array( $problem_category_id ) );
	}

	//return original problem description
	public function get_orig_prob_descrip ( $problem_id ) {
		$data = DB::select( "SELECT `orig_description` FROM `problem` WHERE `problem_id` = ?;", array( $problem_id ) );
		return $data [ 0 ]->orig_description;
	} 

	//return 1 or 0
	public function update_problem_descrip ( $problem_id, $new_problem_descrip ) {
		return DB::update( "UPDATE `problem` SET `description` = ? WHERE `problem_id` = ?;", array( $new_problem_descrip, $problem_id ) );
	}

}