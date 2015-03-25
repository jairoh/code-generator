$( document ).ready( function () {
	$( "#dialog-confirm" ).hide();
	$( "#dialog-error" ).hide();
	show_problem_status();
	var thread = setInterval( function(){ show_problem_status(); } , 1000 );
} );

function show_problem_status() {
	show_problem_at_hand_status ( $( '#prob_id' ).val(), $( '#user_id' ).val() );
    show_problem_no_attempts ( $( '#prob_id' ).val(), $( '#user_id' ).val() );
}

function show_problem_at_hand_status ( problem_id, user_id ) {
	problem_category_id = $( '#problem_category_id' ).val();

	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() + 'round/get_problem_at_hand_status_id',
		data: {
			problem_id: problem_id,
			user_id: user_id
		}, success: function ( e ) {
			$( '#problem_status_box' ).html( "<kbd class='" + ( ( problem_category_id == 1 )? 'easy' : ( ( problem_category_id == 2 )? 'average' : 'hard' ) ) + "' >Problem Status:</kbd> " + ( ( e != 2 )? '<b class="unsolved" >Unsolved</b>' : '<b class="solved" >Solved</b>' ) );
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

function show_problem_no_attempts ( problem_id, user_id ) {
	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() + 'round/get_problem_no_attempts',
		data: {
			problem_id: problem_id,
			user_id: user_id
		}, success: function ( e ) {
			$( '#attempts_box b' ).html( e );
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

//proceed to another problem
function prompt_next_problem ( problem_id ) {
	setTimeout( function() {
		get_problem_info( 'problem_category_id', problem_id );
		get_problem_info( 'level', problem_id );
			

		//get_problem_info( 'problem_category_id', problem_id);

		if ( category_id == 1 ) cat_name = "Easy";
		else if ( category_id == 2 ) cat_name = "Average";
		else if ( category_id == 3 ) cat_name = "Difficult";
		
		$( '#cat_name' ).html( cat_name );
		$( '#level' ).html( level );

		$( "#dialog-confirm" ).dialog({
			title: "Task Completed!",
			resizable: false,
			height: 160,
			modal: true,
			position: [ 'middle', 200 ],
			buttons: {
				Proceed: function() {
					localStorage.setItem( 'current_structure', '' );
					window.location.href= $( '#root_path' ).val() + "round/" + category_id + "/" + level ;
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});	


	}, 100 );
}

//return problem info
function get_problem_info ( db_column_name, problem_id ) {

	//call the model in ajax
	var jqXHR = $.ajax( {
		async: false,
		type: 'POST',
		url: $( '#root_path' ).val() +  'round/get_problem_info',
		data: {
			db_column_name: db_column_name,
			problem_id: problem_id
		},
		success: function ( e ) {
			if ( db_column_name == 'problem_category_id' ) category_id = e;
			else if (  db_column_name == 'level' ) level = e;
		}, error: function ( jqXHR, exception ) {
			if (jqXHR.status === 0) {
		        alert ('Not connected.\nPlease verify your network connection.');
		    } else if (jqXHR.status == 404) {
		        alert ('The requested page not found. [404]');
		    } else if (jqXHR.status == 500) {
		        alert ('Internal Server Error [500].');
		    } else if (exception === 'parsererror') {
		        alert ('Requested JSON parse failed.');
		    } else if (exception === 'timeout') {
		        alert ('Time out error.');
		    } else if (exception === 'abort') {
		        alert ('Ajax request aborted.');
		    } else {
		        alert ('Uncaught Error.\n' + jqXHR.responseText);
		    }
		}
	} );

}