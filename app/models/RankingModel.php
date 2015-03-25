<?php

Class RankingModel extends Eloquent {


	public function get_all_problems_with_leading_students ( $problem_category_id, $date_selected = "CURDATE()" ) {
		$cat_arr = DB::select( "SELECT `problem_id` FROM `problem` WHERE `problem_category_id` = ?;", array( $problem_category_id ) );
		for ( $x = 0; $x < count( $cat_arr ); $x++ ) {
			$cat_arr [ $x ]->top_students = $this->get_top_students ( $cat_arr [ $x ]->problem_id, 5, $date_selected );
		}

		return $cat_arr;
	}


	public function get_top_students ( $problem_id, $limit, $date_selected ) {
		$date_selected = ( $date_selected != '' )? $date_selected : "CURDATE()";
		
		return DB::select( "SELECT DISTINCT `problem_at_hand`.`user_id`, `problem_at_hand`.`no_attempts`,

				`problem`.`level`,

				CONCAT( `user`.`firstname`, ' ' ,`user`.`lastname` ) AS `full_name`

				FROM `problem_at_hand`, `user`, `problem`

				WHERE `problem_at_hand`.`problem_id` = ? 
				AND `problem_at_hand`.`problem_at_hand_status_id` = 2 
				AND `user`.`user_id` = `problem_at_hand`.`user_id` 
				AND `problem`.`problem_id` = `problem_at_hand`.`problem_id`
				
				AND DATE_FORMAT( `problem_at_hand`.`last_attempt_date`, '%V' ) =  DATE_FORMAT( " . $date_selected . ", '%V' )

				ORDER BY `problem_at_hand`.`no_attempts`, `problem_at_hand`.`problem_id` ASC
				LIMIT ?; ", array( $problem_id, $limit ) );
	}
	
}