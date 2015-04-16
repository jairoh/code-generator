//show problem details in the modal for edit
function feed_problem_details ( category_descrip, problem_id, problem_level ) {
	problem_description = $( '#prob_' + problem_id ).html();

	$( "#cat" ).text( category_descrip );
	$( "#level" ).text( problem_level );
	$( '#text_area_problem_descrp' ).val( problem_description );
	problem_id_selected = problem_id;
}

//restore default problem description
function restore_default_descrip ( ) {
	get_orig_prob_descrip( problem_id_selected );
}

//ajax call orig problem_description
function get_orig_prob_descrip ( problem_id ) {

	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() + 'admin/get_orig_prob_descrip',
		data: {
			problem_id: problem_id
		}, success: function ( e ) {
			$( '#text_area_problem_descrp' ).val( e );
		}, error: function ( jqXHR, exception ) {
			if (jqXHR.status === 0) {
		       return 'Not connected.\nPlease verify your network connection.';
		    } else if (jqXHR.status == 404) {
		       return 'The requested page not found. [404]';
		    } else if (jqXHR.status == 500) {
		       return 'Internal Server Error [500].';
		    } else if (exception === 'parsererror') {
		       return 'Requested JSON parse failed.';
		    } else if (exception === 'timeout') {
		       return 'Time out error.';
		    } else if (exception === 'abort') {
		       return 'Ajax request aborted.';
		    } else {
		       return 'Uncaught Error.\n' + jqXHR.responseText;
			}
		}
	} );
}

//update the selected problem's description
function update_problem_descrip () {
	new_problem_descrip = $( '#text_area_problem_descrp' ).val();
	
	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() + 'admin/update_problem_descrip',
		data: {
			problem_id: problem_id_selected,
			new_problem_descrip: new_problem_descrip
		}, success: function ( e ) {
			if ( e == 1 ) window.location.reload();
			else alert( "Unable to process request." );
		}, error: function ( jqXHR, exception ) {
			if (jqXHR.status === 0) {
		       return 'Not connected.\nPlease verify your network connection.';
		    } else if (jqXHR.status == 404) {
		       return 'The requested page not found. [404]';
		    } else if (jqXHR.status == 500) {
		       return 'Internal Server Error [500].';
		    } else if (exception === 'parsererror') {
		       return 'Requested JSON parse failed.';
		    } else if (exception === 'timeout') {
		       return 'Time out error.';
		    } else if (exception === 'abort') {
		       return 'Ajax request aborted.';
		    } else {
		       return 'Uncaught Error.\n' + jqXHR.responseText;
		    }
		}
	} );

}