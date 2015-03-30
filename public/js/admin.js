//show problem details in the modal for edit
function feed_problem_details ( category_descrip, problem_id, problem_level ) {
	problem_description = $( '#prob_' + problem_id ).text();


	$( "#cat" ).text( category_descrip );
	$( "#level" ).text( problem_id );
	$( '#text_area_problem_descrp' ).text( problem_description );
}

