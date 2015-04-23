var line_error = "";

//check if there is a comparison between two identitifiers; and the identifiers must not be the same
function E_Prob_1_res ( statements_arr ) {

	for ( var i in statements_arr ) {

		//check if there is a comparison between two identitifiers;
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*[A-z][A-z0-9]?\s*==\s*[A-z][A-z0-9]?\s*\)\s*{$/ ) ) {
			
			//and w/ the identifiers must not be the same
			if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?)\s*==\s*\b(?!\1).{1,2}\b\s*\)\s*{$/ ) ) {
				return true;
			}
			
		}
			
	}

	line_error = "Cannot find relational comparison between 2 identifiers if they are equal.";
	return false;
}

//check if there is a comparison: (var_dec < 75 or 75 > var_dec ); and ( ts >= 75 or 75 <= ts )
function E_Prob_2_res ( statements_arr ) {
	found = false;

	for ( var i in statements_arr ) {

		//check if there is a comparison: (var_dec < 75 or 75 > var_dec )
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*<\s*75|75\s*>\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) {
			found = true;
			break;
		}

	}
	if ( ! found ) {
		line_error = "Cannot find relational comparison of the initialized variable if it is less than 75.";
		return false;
	}

	found = false;
	for ( var i in statements_arr ) {

		//and ( ts >= 75 or 75 <= ts )
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*>=\s*75|75\s*<=\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) {
			found = true;
			break;
		}

			
	}

	if ( ! found ) {
		line_error = "Cannot find relational comparison of the initialized variable if it is greater than or equal to 75.";
		return false;
	}

	
	return found;
}

//check if there a comparison between an identifier and a boolean value false
function E_Prob_3_res ( statements_arr ) {
	for ( var i in statements_arr ) {

		//check if there is a comparison between two identitifiers;
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*[A-z][A-z0-9]?\s*==\s*false\s*\)\s*{$/ ) ) return true;
			
	}

	line_error = "Cannot find relational comparison between an identifier and a boolean value 'false.'";
	return false;
}

//check if there a comparison: (var_dec >= 30 )
function E_Prob_5_res ( statements_arr ) {
	for ( var i in statements_arr ) {

		//check if there a comparison: (var_dec >= 30 )
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*>=\s*30|30\s*<=\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) return true;
			
	}

	line_error = "Cannot find relational comparison of the initialized variable if it is greater than or equal to 30.";
	return false;
}

//check if there a comparison: (var_dec >= 50 or 50 <= var_dec ) and (var_dec >= 80 or 80 <= var_dec) 
function A_Prob_3_res ( statements_arr ) {
	found = false;

	for ( var i in statements_arr ) {

		//check if there is a comparison: (var_dec >= 50 or 50 <= var_dec )
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*>=\s*50|50\s*<=\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) {
			found = true;
			break;
		}

	}
	if ( ! found ) {
		line_error = "Cannot find relational comparison of the initialized variable greater than or equals to 50.";
		return false;
	}

	found = false;
	for ( var i in statements_arr ) {

		//and (var_dec >= 80 or 80 <= var_dec) 
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*>=\s*80|80\s*<=\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) {
			found = true;
			break;
		}

			
	}

	if ( ! found ) {
		line_error = "Cannot find relational comparison of the initialized variable greater than or equals to 80.";
		return false;
	}

	
	return found;
}

//check if countdown is from 10 and ( var_dec == 1 or 1 == var_dec )
function A_Prob_4_res ( statements_arr ) {
	found = false;

	for ( var i in statements_arr ) {

		//check if countdown is from 10
		if ( statements_arr [ i ].trim().match( /^\}\s*while\s*\(\s*([A-z][A-z0-9]?\s*(>=\s*1|>\s*0)|(0\s*<|1\s*<=)\s*[A-z][A-z0-9]?\s*)\s*\);$/ ) ) {
			found = true;
			break;
		}

	}
	if ( ! found ) {
		line_error = "Cannot find do while countdown from 10.";
		return false;
	}

	found = false;
	for ( var i in statements_arr ) {

		//and (var_dec == 1 or 1 == var_dec) 
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*==\s*1|1\s*==\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) {
			found = true;
			break;
		}

			
	}

	if ( ! found ) {
		line_error = "Cannot find relational comparison of the initialized variable equals to 1.";
		return false;
	}

	
	return found;
}

//check if the do while loop is from 10
function check_do_while_number_of_loops ( statements_arr, loop_n ) {


	//get the variable_loop_n
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( /^\}\s*while\s*\(\s*(?:0\s*<|1\s*<=)\s*([A-z][A-z0-9]?)\s*\s*\);$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^\}\s*while\s*\(\s*(?:0\s*<|1\s*<=)\s*([A-z][A-z0-9]?)\s*\s*\);$/, "$1" );

			break;
		} else if ( statements_arr [ i ].trim().match( /^\}\s*while\s*\(\s*([A-z][A-z0-9]?)\s*(?:>=\s*1|>\s*0)\s*\);$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^\}\s*while\s*\(\s*([A-z][A-z0-9]?)\s*(?:>=\s*1|>\s*0)\s*\);$/, "$1" );
			break;
		}
		

	}

	//check if the variable_loop_n == 10
	regex = new RegExp( "^int[ ]+" + var_dec + "[ ]*=[ ]*([0-9]{1,9})[ ]*;$" );
	console.log( regex );
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match ( regex ) ) {
			if ( 10 == statements_arr [ i ].trim().replace( regex, "$1" ) ) {
				return true;
			} 
			break;
		}
	}

	line_error = "Do while loop must start from 10.";
	return false;
}