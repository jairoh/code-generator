<?php

Class CategoryModel extends Eloquent {

	//return the problems where the user is allowed to solve
	function get_problems_available ( $user_id ) {
		$prob_availability = array(
			1 => array( 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0 ),
			2 => array( 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0 ),
			3 => array( 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0 )
		);

		$problems = DB::select( "SELECT DISTINCT `problem`.`problem_category_id`, `problem`.`level`, `problem_at_hand`.`problem_id`, 
			`problem_at_hand`.`problem_at_hand_status_id`
			FROM `problem_at_hand`, `problem` 
			WHERE `problem_at_hand`.`problem_id` = `problem`.`problem_id` AND `problem_at_hand`.`problem_at_hand_status_id` = 2 AND `problem_at_hand`.`user_id` = ?;", array( $user_id ) );

		foreach ( $problems as $problem ) {

			$prob_availability [ $problem->problem_category_id ] [ $problem->level ] = $problem->problem_at_hand_status_id;

			//open next problem if the last problem is solved
			if ( $problem->problem_at_hand_status_id == 2  ) {

				if ( $problem->level < 5 ) $prob_availability [ $problem->problem_category_id ] [ $problem->level + 1 ] = 1;
				else if ( $problem->level == 5 && $problem->problem_category_id != 3 ) {
					$prob_availability [ $problem->problem_category_id + 1 ] [ 1 ] = 1;
				}

			}


		}

		return $prob_availability;
	}

}
