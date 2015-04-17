// -1 	= missing
//  0 	= not included
//  1	= no problem
var problem_requirements_arr = {
	var_dec : 0,
	print_stmts : 0,
	conditional_stmts : 0,
	repetition_stmts : 0,
	output: 1,
	structure: -1,
	grammar: 1
};
var all_requirements_met = true;
var fragment = "";
var line_error = "";

function clearValues () {
	problem_requirements_arr = {
		var_dec : 0,
		print_stmts : 0,
		conditional_stmts : 0,
		repetition_stmts : 0,
		output: 1,
		structure: -1,
		grammar: 1
	};
	all_requirements_met = true;
	fragment = "";
	line_error = "";
}


//convert String "VS;IS{PL;}IS{PL;}" into array [ 'VS', 'IS', 'PL', ... ]
function tokenizeTags ( str ) {
	var tags_array;
	var regex = new RegExp( /([A-Z]{2,3})/g );
	var return_arr = [];

	while ( ( tags_array = regex.exec( str ) ) != null)  
	{  
	  return_arr.push( tags_array [ 1 ] );
	} 

	return return_arr;
}

//generate the code
function generateCode() {
	clearValues(); //re assign value
	
	//spit the tags w/ by the newlines 
	var input_arr = $( '#dock_box' ).html().split( />/ );

	//filtered tags
	var input_arr_filtered = filterTags( input_arr );


	//show output with prettyPrint
	fragment = htmlEntitiesToSymbol( translateTags( input_arr_filtered ) );

	//console.log( translateTags( input_arr_filtered ) );

	$( '#generate_here' ).html( ' ' );
	$( '#generate_here' ).html( '<pre class="prettyprint linenums">' + fragment + '</pre>' );
	prettyPrint();

	
	fragment = fragment.replace( /&quot;/g, '"' );
	fragment_arr = fragment.split( "\n" );

	//check grammar	
	console.log( fragment_arr );
	problem_requirements_arr [ 'grammar' ] = ( grammmar_check ( fragment_arr ) )? 1 : -1;

}//end generate code

//replace html codes to symbols
function htmlEntitiesToSymbol ( str ) {
	str = str.replace( /&quot;/g, '"' );
	str = str.replace( /(&lt;=|&amp;lt;=)/g, " \<\= " );
	str = str.replace( /(&gt;=|&amp;gt;=)/g, ' \>\= ' );
	str = str.replace( /(&lt;|&amp;lt;)/g, " \<\ " );
	str = str.replace( /(&gt;|&amp;gt;)/g, ' \>\ ' );

	return str;
}


//execute code
function executeCode () {
	//disable button while sending a request
	$( '#generate_button' ).attr( {
		'disabled' : 'disabled',
		'class' : 'loading generate_btn'
	} );
	$( '#generate_button a' ).text("Executing code...");
	$( '#output_box' ).html( "<pre><b>Processing request...<br/>If this is taking so long. Try checking your internet connection and reload the page.</b></pre>" );


	//make a request using CORS to cross another domain
	var data = new FormData();
	data.append('LanguageChoiceWrapper', '4');
	data.append('Program', 'class Rextester {  public static void main(String args[]){ ' + fragment + ' } }' );
	data.append('Input', '' );
	makeCorsRequest( 'POST', 'http://rextester.com/rundotnet/api', data );

}

//show result
function showResult ( CORS_request_made ) {
	problem_category_id = $( '#problem_category_id' ).val();

	//evaluate solution if there's a connection only
	if ( CORS_request_made ) {
		console.log( execute_results_arr );
		console.log( "User Input Structure: " + user_input_structure + "\n" );
		
		checkTagRequirementsUnMet( tokenizeTags( $( '#e_structure' ).val() ) ,tokenizeTags( user_input_structure ) );

		//check if the requirements weren't met
		//ifRequirementsMet();


		//limit output display
		var execution_output = ( ( execute_results_arr [ 'result' ] != '' ) ? execute_results_arr [ 'result' ] : 'None' );
		var n_of_newlines = execution_output.split( /\n/ ).length;

		var output_limited = "";
		if ( parseInt( n_of_newlines ) > 10 ) {
			for ( var x = 0; x < 10; x++ ) {
				output_limited += execution_output [ x ];
				//console.log( x + " = " + execution_output [ x ] );
			}
			//output_limited += "..."; 
		} else {
			output_limited = execution_output;
			if ( execution_output.length > 100 ) 
				 output_limited = execution_output.replace( /^(.{0,100})/, '$1' );
		}



		//display output
		$( '#output_box' ).html( '<pre>' + 
			"<b class='req' >Output</b>: <br/><a id='compapi_output' >" + output_limited  + "</a>" +
			//"\nError: " + ( ( execute_results_arr [ 'errors' ] != '' ) ? execute_results_arr [ 'errors' ] : 'None' )
			'</pre>' 
		);

		//check grammar	
		if ( ! grammmar_check ( fragment.split( "\n" ) ) ) $( '#output_box pre' ).append( "\n<b class='req' >Compiler Error</b> : <b class='error' >" + get_grammar_error() + "</b>" );
	} else {
		//display output
		$( '#output_box' ).html( "<b class='req' >Connection Error</b> : <b class='error' >Connection lost. Try checking you internet connection and reload the page.</b>" );
	}

	//enable button again
	//disable button while sending a request
	$( '#generate_button' ).attr( {
		'class' :  ( problem_category_id == 1 )? 'easy' : ( ( problem_category_id == 2 )? 'average' : 'hard' )
	} ).removeAttr( "disabled" );
	$( '#generate_button a' ).text( "Execute Code" );

}

//check if the requirements have been met
function ifRequirementsMet () {
	setTimeout( function() { //add delay

		//check output if match
		user_input_output = ( ( execute_results_arr [ 'result' ] != '' && execute_results_arr [ 'result' ] != null ) ? execute_results_arr [ 'result' ] : '' );
		user_input_output_filtered = user_input_output.replace( /^\s*\b(.+)\b\s*$/, '$1' ).trim();
		
		if ( user_input_output_filtered.match( $( '#e_output' ).val() ) ) problem_requirements_arr [ 'output' ] = 1;
		else problem_requirements_arr [ 'output' ] = -1;

		/*if ( user_input_structure.match( $( '#e_structure' ).val() ) ) problem_requirements_arr [ 'structure' ] = 1;
		else problem_requirements_arr [ 'structure' ] = -1;*/

		//check missing requirements
		all_requirements_met = true; //true before using
		for ( var key in problem_requirements_arr ) {
			if ( parseInt( problem_requirements_arr [ key ] ) == -1 ) {
				//console.log( key + " = " + problem_requirements_arr [ key ] );
				all_requirements_met = false;
				break;
			}
		}

		console.log( "\nRequirements Completion: " );
		console.log( problem_requirements_arr );
		
		var str = ( all_requirements_met )? "Congratulations! Try again." : "Sorry! You we can't allow that sturcture. Try again.";
	
		
		
		$( '#output_box pre' ).append( "\n\n" + showCompletionOfTags() );

		$( '#output_box pre' ).append( "\n\n<b>" + str + "</b>" );

		problem_id = parseInt( $( '#prob_id' ).val() );

		//for adding attempts
		checkIfProblemAtHandExists( problem_id, $( '#user_id' ).val() );

		
		//proceed to next problem if the currrent problem has been solved
		if ( all_requirements_met ) { 
			if ( problem_id < 15  )
				prompt_next_problem( problem_id + 1 );
			else alert( "Congratulations! You've finished all the problems!" );
		} else {
			$( "#dialog-error" ).dialog({
				title: "Error!",
				resizable: false,
				height: 160,
				width: 350,
				modal: true,
				position: [ 'middle', 200 ],
				buttons: {
					Close: function() {
						$( this ).dialog( "close" );
					}
				}
			});	
		}

	}, 100 );
}

//check if the tag requirements were met
function checkTagRequirementsUnMet ( expected_tags_arr, input_tags_arr ) {
	
	var missing_tags = [];

	console.log( "Expected: " + expected_tags_arr );
	console.log( "   Input: " + input_tags_arr );

	//put 1 to problem_requirements_arr if a kind tag is found required
	expected_tags_arr_n = expected_tags_arr.length;
	for ( var i = 0; i < expected_tags_arr_n; i++ ) {
		UpdateCompletionTagsStr ( expected_tags_arr [ i ], 1 );
	}

	//check if the tags match; get the missing tags
	input_tags_arr_n = input_tags_arr.length;

	found = false;
	for ( x = 0; x < expected_tags_arr_n; x++ ) {

		for ( y = 0; y < input_tags_arr_n; y ++ ) {
			if ( expected_tags_arr [ x ] == input_tags_arr [ y ] ) {
				input_tags_arr.splice( y, 1 );
				found = true;
				break;
			}

		}

		if ( ! found ) missing_tags.push( expected_tags_arr [ x ] );
		else found = false;
	}

	//put -1 to problem_requirements_arr if a kind tag is missing
	missing_tags_n = missing_tags.length;
	for ( var i = 0; i < missing_tags_n; i++ ) {
		UpdateCompletionTagsStr ( missing_tags [ i ], -1 );
	}

	console.log( "Missing: " + missing_tags );

}

//return missing tags in string
function UpdateCompletionTagsStr ( tag, value ) {

	//value
	// -1 	= missing
	//  0 	= not included
	//  1	= no problem
	
	if ( String( tag ).match( /(VS|VC|VF|VI|VD|VB)/ ) ) problem_requirements_arr [ 'var_dec' ] = value;
	else if ( String( tag ).match( /(P|PL)/ ) ) problem_requirements_arr [ 'print_stmts' ] = value;
	else if ( String( tag ).match( /(IS|ES|EIS|SS|CS|CDS)/ ) ) problem_requirements_arr [ 'conditional_stmts' ] = value;
	else if ( String( tag ).match( /(WS|DWS|FS)/ ) ) problem_requirements_arr [ 'repetition_stmts' ] = value;

}

//show completion of tags str
function showCompletionOfTags () {
	//show completion
	var completion_str = "<b class='req_title' >Requirements:</b>";
	
	if ( problem_requirements_arr [ 'grammar' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Grammar</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'grammar' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Grammar</b>: <b class='error' >X</b>"; 

	if ( problem_requirements_arr [ 'var_dec' ] == 1 ) completion_str += "\n\t<b class='check' >→</b><b class='req' >Variable Declaration(s)</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'var_dec' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Variable Declaration(s)</b>: <b class='error' >X</b>";

	if ( problem_requirements_arr [ 'print_stmts' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Print Statement(s)</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'print_stmts' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Print Statement(s)</b>: <b class='error' >X</b>";

	if ( problem_requirements_arr [ 'conditional_stmts' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Conditional Statement(s)</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'conditional_stmts' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Conditional Statement(s)</b>: <b class='error' >X</b>";

	if ( problem_requirements_arr [ 'repetition_stmts' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Repetition Statement(s)</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'repetition_stmts' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Repetition Statement(s)</b>: <b class='error' >X</b>";

	if ( problem_requirements_arr [ 'output' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Output</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'output' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Output</b>: <b class='error' >X</b>"; 

	if ( problem_requirements_arr [ 'structure' ] == 1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Tag Structure</b>: <b class='check' >√</b>";
	else if ( problem_requirements_arr [ 'structure' ] == -1 ) completion_str += "\n\t<b class='check' >→<b class='req' >Tag Structure</b>: <b class='error' >X</b>"; 

	return completion_str;
}

//returns true if the problem at hand exists
function checkIfProblemAtHandExists ( problem_id, user_id ) {
	//call the model in ajax
	$.ajax( {
		type: 'POST',
		async: false,
		url: $( '#root_path' ).val() + 'round/check_if_problem_at_hand_exists',
		data: {
			problem_id: problem_id,
			user_id: user_id
		}, success: function ( e ) {
			
			//add attempts
			if ( ! e ) {
				insertProblemAtHand ( problem_id, user_id, ( ( all_requirements_met )? 2 : 1 )  );
			} else {
				addAttemptsProblemAtHand ( problem_id, user_id, ( ( all_requirements_met  )? 2 : 1 )  );
			}

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

//insert new problem at hand
function insertProblemAtHand ( problem_id, user_id, problem_at_hand_status_id ) {
	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() +  'round/insert_problem_at_hand',
		data: {
			problem_id: problem_id,
			user_id: user_id,
			problem_at_hand_status_id: problem_at_hand_status_id
		}, success: function ( e ) {
			//alert( e );
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

//add attemps; PROBLEM - still add attempts even it has already been solved
function addAttemptsProblemAtHand ( problem_id, user_id, problem_at_hand_status_id ) {
	//call the model in ajax
	$.ajax( {
		type: 'POST',
		url: $( '#root_path' ).val() + 'round/add_attempts_problem_at_hand',
		data: {
			problem_id: problem_id,
			user_id: user_id,
			problem_at_hand_status_id: problem_at_hand_status_id
		}, success: function ( e ) {
			//alert( e );
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