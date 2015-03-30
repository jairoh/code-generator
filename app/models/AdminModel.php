<?php

class AdminModel extends Eloquent {
	
	public function get_all_problems ( $problem_category_id ) {
		return DB::select( "SELECT `problem_id`, `level`, `description` FROM `problem` WHERE `problem_category_id` = ?;", array( $problem_category_id ) );
	}



}