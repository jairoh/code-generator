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
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?\s*==\s*false|false\s*==\s*[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) return true;
			
	}

	line_error = "Cannot find relational comparison between an identifier and a boolean value 'false.'";
	return false;
}

//check if the switch variable parameter has a character data type
function E_Prob_4_res ( statements_arr ) {
	passed = false;
	switch_index = 0;


	//get the identifier parameter in the switch statement
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( /^switch\s*\(\s*[A-z][A-z0-9]?\s*\)\s*\{$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^switch\s*\(\s*([A-z][A-z0-9]?)\s*\)\s*\{$/, "$1" );
			switch_index = i;
			break;
		}

	}


	//find the character variable
	regex = RegExp( "^char[ ]+" + var_dec + "[ ]+.+;" );
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( regex ) ) { 
			passed =  true;
			break;
		}
	}
	if ( ! passed ) {
		line_error = "Cannot find switch statement with a parameter of character variable.";
		return false;
	}
	

	//check if cases A-E is found
	cases_required = {
		A : -1,
		B : -1,
		C : -1,
		D : -1,
		E : -1,
	};
	for ( var i = switch_index; i < statements_arr.length; i++ ) {
		if ( statements_arr [ i ].trim().match( /^case\s+'A'\s*:$/ ) ) cases_required [ 'A' ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+'B'\s*:$/ ) ) cases_required [ 'B' ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+'C'\s*:$/ ) ) cases_required [ 'C' ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+'D'\s*:$/ ) ) cases_required [ 'D' ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+'E'\s*:$/ ) ) cases_required [ 'E' ] = 1;
	}
	if ( cases_required [ 'A' ] == -1 ) { line_error = "Cannot find case conditional 'A'."; return false; }
	if ( cases_required [ 'B' ] == -1 ) { line_error = "Cannot find case conditional 'B'."; return false; }
	if ( cases_required [ 'C' ] == -1 ) { line_error = "Cannot find case conditional 'C'."; return false; }
	if ( cases_required [ 'D' ] == -1 ) { line_error = "Cannot find case conditional 'D'."; return false; }
	if ( cases_required [ 'E' ] == -1 ) { line_error = "Cannot find case conditional 'E'."; return false; }

	return passed;

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

//check if the switch variable parameter has a integer data type
function A_Prob_1_res ( statements_arr ) {
	passed = false;
	switch_index = 0;

	//get the identifier parameter in the switch statement
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( /^switch\s*\(\s*[A-z][A-z0-9]?\s*\)\s*\{$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^switch\s*\(\s*([A-z][A-z0-9]?)\s*\)\s*\{$/, "$1" );
			switch_index = i;
			break;
		}

	}


	//find the character variable
	regex = RegExp( "^int[ ]+" + var_dec + "[ ]+.+;" );
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( regex ) ) { 
			passed =  true;
			break;
		}

	}

	if ( ! passed ) {
		line_error = "Cannot find switch statement with a parameter of integer variable.";
		return false;
	}

	//check if cases 1-5 is found
	cases_required = {
		1 : -1,
		2 : -1,
		3 : -1,
		4 : -1
	};
	for ( var i = switch_index; i < statements_arr.length; i++ ) {
		if ( statements_arr [ i ].trim().match( /^case\s+1\s*:$/ ) ) cases_required [ 1 ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+2\s*:$/ ) ) cases_required [ 2 ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+3\s*:$/ ) ) cases_required [ 3 ] = 1;
		if ( statements_arr [ i ].trim().match( /^case\s+4\s*:$/ ) ) cases_required [ 4 ] = 1;
	}
	if ( cases_required [ 1 ] == -1 ) { line_error = "Cannot find case 1:."; return false; }
	if ( cases_required [ 2 ] == -1 ) { line_error = "Cannot find case 2:."; return false; }
	if ( cases_required [ 3 ] == -1 ) { line_error = "Cannot find case 3:."; return false; }
	if ( cases_required [ 4 ] == -1 ) { line_error = "Cannot find case 4:."; return false; }

	return passed;

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
		line_error = "Cannot find do while countdown from 10 to 1.";
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
	loop_validity = false;
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match ( regex ) ) {
			if ( 10 == statements_arr [ i ].trim().replace( regex, "$1" ) )
				loop_validity = true;
			break;
		}
	}
	if ( ! loop_validity ) {
		line_error = "Do while loop must start from 10.";
		return false;
	}
	return true;
}


//check if countdown is from 10 and ( var_dec == var_dec )
function A_Prob_5_res ( statements_arr ) {
	for ( var i in statements_arr ) {

		//check there must be loop between two identitifiers;
		if ( statements_arr [ i ].trim().match( /^while\s*\(\s*[A-z][A-z0-9]?\s*(?:==|!=|>|<|>=|<=)\s*[A-z][A-z0-9]?\s*\)\s*{$/ ) ) {
			
			//and w/ the identifiers must not be the same
			if ( statements_arr [ i ].trim().match( /^while\s*\(\s*([A-z][A-z0-9]?)\s*(?:==|!=|>|<|>=|<=)\s*\b(?!\1).{1,2}\b\s*\)\s*{$/ ) ) {
				return true;
			}
			
		}
			
	}

	line_error = "Cannot find a loop from an identifier to another.";
	return false;
}

//check if there's a print( var_integer ) inside the check_do_while
function D_Prob_1_res ( statements_arr ) {

	var_dec = "";
	counter = 0;

	//get the variable name
	for ( var i in statements_arr ) {

		if ( statements_arr [ i ].trim().match( /^\}\s*while\s*\(\s*21\s*>\s*([A-z][A-z0-9]?)\s*\);$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^\}\s*while\s*\(\s*21\s*>\s*([A-z][A-z0-9]?)\s*\);$/, "$1" );
			counter = i;
			break;
		} else if ( statements_arr [ i ].trim().match( /^\}\s*while\s*\(\s*([A-z][A-z0-9]?)\s*<\s*21\s*\);$/ ) ) {
			var_dec = statements_arr [ i ].trim().replace( /^\}\s*while\s*\(\s*([A-z][A-z0-9]?)\s*<\s*21\s*\);$/, "$1" );
			counter = i;
			break;
		}
		
	}
	
	//check if the var int has been displayed previously
	if ( var_dec.match( /[A-z][A-z0-9]?/ ) ) {
		regex = new RegExp( "^System.out.println[(][ ]*" + var_dec + "[ ]*[)];$" );
		
		//check prev
		for ( var i = counter - 1; i >= 0; i-- ) {
			if ( statements_arr [ i ].trim().match( regex ) ) return true;
		}

		line_error = "Cannot find a println statement w/ a parameter of an integer variable inside the do while loop.";
		return false;

	}


	line_error = "Cannot find do while loop relational comparison of the initialized variable less than 21";
	return false;
	

}