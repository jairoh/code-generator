var line_error = "";


/*
	Loops through the array of statements; and
	determined if it's valid
	Return: boolean
*/
function lexical_anaylize ( statements_arr ) {
	var code_validity = true;

	for ( var i in statements_arr ) {

		//remove indents
		var str = statements_arr [ i ].trim();

		if ( ! is_prefix_valid ( str, i ) ) {
			console.log( "Invalid keyword \"" + str.replace( /^\b([^ ]+)\b\s.*$/, "$1" ) + "\" on line number " + ( parseInt( i ) + 1 ) + "." );
			return false;
		} else {

			//check the validity of the operands of a function statement
			if ( str.match( /^System|if|else if|switch|for|(?:}\s*)?while/ ) )
				if ( ! validate_operands ( str, i ) ) {
					code_validity = false;
					break;
				};

			//check the syntax of the statement
			if ( ! check_sytax_statement ( str, i, statements_arr ) ) {
				code_validity = false;
				break;
			}

			//type check
			if ( ! type_check_statements ( str, i , statements_arr ) ) {
				code_validity = false;
				break;
			}

		}
	}
	return code_validity;
}

/*
	Check if the prefix is valid
	Return: boolean
*/
function is_prefix_valid ( statement, linenum ) {
	if ( statement.match( /^(int|double|float|String|char|boolean)\s/ ) ) return true;
	else if ( statement.match( /^(if|else if|else|switch|case|default|break)/ ) ) return true;
	else if ( statement.match( /^((?:}\s*)?while|do|for)\s/ ) ) return true;
	else if ( statement.match( /^}$/ ) ) return true;
	else if ( statement.match( /^System.out.print/ ) ) return true;
	else if ( statement.match( /^\s*$/ ) ) return true;
	else if ( statement.match( /^[A-z][A-z0-9]?\s*=/ ) ) return true;
	else return false;
}

//check the validity of the operands of a function statement
function validate_operands ( statement, linenum ) {

	//for foorloop, check if the input length is an integer
	if ( statement.match( /^for/ ) ) {

		if ( ! statement.match( /^for\s*\(\s*int\s([A-z][A-z0-9]?)\s*=\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*([A-z][A-z0-9]?)\s*(?:==|!=|>|<|>=|<=)\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*([A-z][A-z0-9]?)([\-+]{2})\s*\)\s*{$/ ) ) {
			line_error = "Invalid parameters in for-loop statement on line number " + ( parseInt( linenum ) + 1 ) + ".";
			return false;
		}



	} else {

		//get the parameter line
		parameter_line = statement.replace( /^(?:System\.out\.print(?:ln)?|if|else if|switch|(?:\}\s*)?while)\s*\(([^)]*)\)(?:;|\s*\{)|(case\s+[^:]):$/, "$1" ).trim();
		parameter_line = parameter_line.replace( /&quot;/g, '"' );

		//put all the operands in an array
		operands_arr = parameter_line.match( /(?:(')[^']\1)|(?:(")[^"]+\2)|(?:[^'"=!><\ ]+)/g );


		var n = ( isNaN( operands_arr ) )? operands_arr.length : 0;
		
		for ( var x = 0; x < n; x++ ) {
			if ( ! is_operand_valid( operands_arr [ x ], linenum ) ) return false;
		}

	}

	return true;
}

//returns true if the operand is valid
function is_operand_valid ( operand, linenum ) {
	//console.log( operand );

	operand = operand.replace( /&quot;/g, '"' );

	if ( operand.match( /^[A-z][A-z0-9]?$/ ) || //variable
		operand.match( /^[0-9]{1,9}$/ ) || //integer
		operand.match( /(^[0-9]{1,9}\.[0-9]{0,2}$)|(^[0-9]{0,9}\.[0-9]{1,2}$)/ ) || //double
		operand.match( /^"[^"]{0,50}"$/ ) || //String
		operand.match( /^'[^']'$/ ) || //char
		operand.match( /^(true|false)$/ ) ) //boolean
		
		return true;
	else {
		line_error = "Cannot identify operand '" + operand + "' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}	

	
}


//check the whole line of the statement
function check_sytax_statement ( statement, linenum, statements_arr ) {

	//check var dec 
	if ( statement.match( /^(?:int|double|float|String|char|boolean)\s/ ) ) {
		if ( check_var_dec ( statement, linenum ) ) return true;
		else return false;
	}
	//check conditional statements
	else if ( statement.match( /^(?:if|else if|switch|case)\s/ ) ) {
		if ( check_type_of_statement ( statement, linenum ) ) return true;
		else return false;
	}
	//check repetitional statements
	else if ( statement.match( /^((?:}\s*)?while|do|for)\s/ ) ) {

	}
	else if ( statement.match( /^}$/ ) ) {

	}
	//chech print statements
	else if ( statement.match( /^System.out.print/ ) ) {
		if ( check_print_statement ( statement, linenum, statements_arr ) ) return true;
		else return false;
	}

	return true;
}

//type checking will happen in here
function type_check_statements ( statement, linenum, array ) {

	//check var dec 
	if ( statement.match( /^(?:int|double|float|String|char|boolean)\s/ ) ) {
		if ( check_var_redundancy ( statement, linenum, array ) ) return true;
		else return false;
	}
	//check variable parameters if they have been declared or initialized
	else if ( statement.match( /^(?:System\.out\.print(?:ln)?|if|else if|switch|(?:}\s*)?while)\s*/ ) ) { 
		if ( check_if_var_has_been_declared ( statement, linenum, array ) ) {
			
			//check operands accessible
			if ( are_operands_accessible ( statement, linenum, array ) ) {
				//check identfiers and constants match in their data types
				if ( check_identifiers_and_constant_match ( statement, linenum, array ) ) return true;
			}
			return false;
		}
		return false;
		
	}
	//check if case condition value redundant
	else if ( statement.match( /^case\s+(.+):$/ ) ) {
		if ( check_case_condition_value_redundancy( statement, linenum, array ) ) {
			if ( check_case_and_switch_data_types_match( statement, linenum, array ) ) return true;
		}

		return false;
	}
	//check for loop
	else if ( statement.match( /^for/ ) ) {
		
		//check if the declared integer var in the loop is redundant
		if ( check_forloop_var_dec_unique ( statement, linenum, array ) ) {
			//check variable parameters if they have been declared or initialized
			if ( check_if_var_has_been_declared ( statement, linenum, array ) ) {
				//check operands accessible
				if ( are_operands_accessible ( statement, linenum, array ) ) {
					return true;
				}
			}
		}
		return false;
	}

	return true;
}