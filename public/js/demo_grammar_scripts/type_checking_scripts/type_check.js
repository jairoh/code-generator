var line_error = "";

//check if the declared variable is redundant
function check_var_redundancy ( str, linenum, array ) {
	if ( linenum == 0 ) return true;

	var value = str.replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" );
	
	//loop through the previous values
	for ( var i = 0; i < linenum; i++ ) {
		var prev_value = array [ i ].replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" );
		

		if ( value == prev_value ) {
			line_error = "Variable '" + value + "' on line number " + ( parseInt( linenum ) + 1 ) + " already in use.";
			return false;
		}																			
	}

	return true;
}
																																																	
//check if the variables in the condition/repetition																																
function check_if_var_has_been_declared ( str, linenum, array ) { 
	//get the parameter line
	parameter_line = str.replace( /^(?:System\.out\.print(?:ln)?|if|else if|switch|for|(?:\}\s*)?while)\s*\(([^)]*)\)(?:;|\s*\{)|(case\s+[^:]):$/, "$1" ).trim();
		
	//replace everything in the forloop condition apart from $2 and $3 => (int a = $2; a < $3; a++) 
	parameter_line = parameter_line.replace( /^int\s([A-z][A-z0-9]?)\s*=\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1\s*(?:==|!=|>|<|>=|<=)\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1([\-+]{2}|[\-+]=[0-9]{1,9})$/, "$2 $3" );


	//put all the identifiers in an array
	identifier_arr = parameter_line.replace( /(".+"|'.+'|&quot;.+&quot;)/g, "" ).match( /[A-z][A-z0-9]*/g );

	//console.log( "Line " + linenum + " = " + parameter_line );

	var n = ( isNaN( identifier_arr ) )? identifier_arr.length : 0;

	//require an identifier with while statements
	if ( str.match( /^(?:}\s*)?while/ ) && n == 0 ) {
		line_error = "Cannot find an identifier on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}

	//check variables parameters if they have been declared already
	for ( var i = 0; i < n; i++ ) {
		
		if ( ! identifier_arr [ i ].match( /quot|null|undefined|true|false/ ) ) {

			//check
			if ( ! if_variable_found_declared_in_prev_lines ( identifier_arr [ i ], linenum, array ) ) {
				line_error = "Identifier '" + identifier_arr [ i ] + "' on line number " + ( parseInt( linenum ) + 1 ) + " has not been declared.";
				return false;
			}
		}

	}
	

	return true;
}

//return true if the variable was found in from the previous lines
function if_variable_found_declared_in_prev_lines ( identifier, linenum, array ) {

	//loop through the previous values
	for ( var i = 0; i < linenum; i++ ) {
		if ( array [ i ].trim().match( /^\s*\b(?:for\s*[(]\s*int|int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/ ) ) {
			//console.log( identifier + " == " + array [ i ].replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" ) + "?" );

			if ( identifier == array [ i ].trim().replace( /^\s*\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" ) || 
				identifier == array [ i ].trim().replace( /^for\s*[(]\s*int\s*([A-z0-9]+)\s*.+$/, "$1" )) //forloop initialization
				return true;
		}
	}

	return false;
}

//check conditional statement's identifiers & constants if they have the same data type
function check_identifiers_and_constant_match ( str, linenum, array ) {

	//get the parameter line
	parameter_line = str.replace( /^(?:System\.out\.print(?:ln)?|if|else if|switch|for|(?:\}\s*)?while)\s*\(([^)]*)\)(?:;|\s*\{)|(case\s+[^:]):$/, "$1" ).trim();
	parameter_line = parameter_line.replace( /&quot;/g, '"' );

	//put all the operands in an array
	operands_arr = parameter_line.match( /(?:(['"])[^'"=!><]+\1)|(?:[^'"=!><\ ]+)/g );

	//get the relational operator
	rel_op = parameter_line.replace( /^.+(==|!=|>|<|>=|<=).+$/, '$1' );

	var data_type_in_cur_line = "";
	var data_type_in_prev_line = "";

	
	//loop through the operands array
	var n = ( isNaN( operands_arr ) )? operands_arr.length : 0;
	for ( var i = 0; i < n; i++ ) {

		//get the data type of the identifier
		if ( operands_arr [ i ].match( /^[A-z][A-z0-9]?$/ ) ) {
			data_type_in_cur_line =  get_indentifier_data_type ( operands_arr [ i ], linenum, array );
		} else { 
			//get the data type of the value
			data_type_in_cur_line = get_constant_data_type ( operands_arr [ i ] );
		}

		if ( i > 0 ) {
			arr = [ 'String', 'char' ];
			if ( data_type_in_cur_line != data_type_in_prev_line && ! ( arr.indexOf( data_type_in_prev_line ) != -1 && arr.indexOf( data_type_in_cur_line ) != -1 ) ) {
				line_error = "Operands {" + operands_arr + "} on line number " + ( parseInt( linenum ) + 1 ) + " do not share the same data types.";
				return false;
			} else {
				arr.push( 'boolean' );

				//allow only "===" or "!=" for char, String, and boolean operands
				if ( arr.indexOf( data_type_in_prev_line ) != -1 || arr.indexOf( data_type_in_cur_line ) != -1  ) {
					if ( rel_op !== '==' && rel_op != '!=' ) {
						line_error = "Cannot use relational operator '" + rel_op + "' on line number " + ( parseInt( linenum ) + 1 ) + ". Use only '==' or '!='.";
						return false;
					}
				}


				//if ( data_type_in_prev_line == "int" || data_type_in_prev_line == "double" ) {}
			}
		} 
		data_type_in_prev_line = data_type_in_cur_line;
	}

	return true;
}

//return the data type of the constant
function get_constant_data_type ( constant ) {
	if ( constant.match( /^[0-9]{1,9}$/ ) ) return "int";
	else if ( constant.match( /(^[0-9]{1,9}\.[0-9]{0,2}$)|(^[0-9]{0,9}\.[0-9]{1,2}$)/ ) ) return "double";
	else if ( constant.match( /^"[^"]{0,50}"$/ ) ) return "String";
	else if ( constant.match( /^'[^']'$/ ) ) return "char";
	else if ( constant.match( /^(true|false)$/ ) ) return "boolean";
	else return "no data type";
}

//returns the data type equivalent value of the identifier
function get_indentifier_data_type ( identifier, linenum, array ) {

	//loop through the previous codes	
	for ( var i = 0; i < parseInt( linenum ); i++ ) {

		if ( array [ i ].trim().match( /^(int|double|float|String|char|boolean)\s/ ) ) {
			var regex = new RegExp( "^(int|double|float|String|char|boolean) " + identifier ); 

			if ( array [ i ].trim().match( regex )  )
				return array [ i ].trim().replace( /^(int|double|float|String|char|boolean)\s+[A-z][0-9A-z]?\s*=\s*[^;]*\s*;$/, '$1' );
		}
		
	}

	return "no data type";
}

function are_operands_accessible ( str, linenum, array ) {
	//get the parameter line
	parameter_line = str.replace( /^(?:System\.out\.print(?:ln)?|if|else if|switch|for|(?:\}\s*)?while)\s*\(([^)]*)\)(?:;|\s*\{)|(case\s+[^:]):$/, "$1" ).trim();
		
	//replace everything in the forloop condition apart from $2 and $3 => (int a = $2; a < $3; a++) 
	parameter_line = parameter_line.replace( /^int\s([A-z][A-z0-9]?)\s*=\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1\s*(?:==|!=|>|<|>=|<=)\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1([\-+]{2}|[\-+]=[0-9]{1,9})$/, "$2 $3" );

	//put all the identifiers in an array
	identifier_arr = parameter_line.replace( /(".+"|'.+'|&quot;.+&quot;|true|false)/g, "" ).match( /[A-z][A-z0-9]*/g );


	var n = ( isNaN( identifier_arr ) )? identifier_arr.length : 0;
	
	for ( var i = 0; i < n; i++ ) {
		if ( ! is_variable_accessible ( identifier_arr [ i ], linenum, array ) ) return false;
	}

	return true;
} 

//returns true if the variable is accessible: ACCESS CONTROL
function is_variable_accessible ( identifier, linenum, array ) {
	var braces_pattern = "";
	var last_symbol = "";

	//loop through the previous codes starting at the pointer-up
	for ( var i = linenum - 1; i >= 0; i-- ) {
			
		//add '}' for for loop
		var reg = new RegExp( "for[ ]*[(][ ]* int " + identifier );
		if ( array [ i ].trim().match( reg ) ) braces_pattern += "}";

		//append braces into a string
		last_symbol = array [ i ].replace( /^.*([{}])$/, "$1" );
		if ( last_symbol.match( /^[{}]$/ ) ) braces_pattern += last_symbol + "";
		
		//stop where the initialization was found
		var regex = new RegExp( "^(for[ ]*[(][ ]*int|int|double|float|String|char|boolean) " + identifier ); 
		if ( array [ i ].trim().match( regex )  ) {


			//remove '}{'; due to cancellation
			while ( braces_pattern.match( /\}\{/ ) ) {
				braces_pattern = braces_pattern.replace( /\}\{/g, "" );
			}

			//console.log( braces_pattern );

			break;
		}

	}

	var n_close_parens = ( braces_pattern.match( /[}]/g ) || [] ).length;
	var n_open_parens = ( braces_pattern.match( /[{]/g ) || [] ).length;

	//console.log( braces_pattern + ": Close Paren: " + n_close_parens + "\tOpen Paren: " + n_open_parens );

	//if n of '}' >= n of '{', return false, else return true
	if ( ( n_close_parens != 0 || n_open_parens != 0 ) && ( n_close_parens >= n_open_parens ) ) {
		line_error = "Cannot access identifier '" + identifier + "' from line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}


	return true;
}

//function check case condition_value redundancy value redundancy
function check_case_condition_value_redundancy ( statement, linenum, array ) {
	n = array.length;
	
	for ( var i = parseInt( linenum ) + 1; i < n; i++ ) {
		
		arr_val = array[ i ].trim();
		
		if ( statement == arr_val ) {
			condition_val = arr_val.replace( /^case\s+([^:]+)\s*:$/, '$1' );
			line_error = "Cannot reuse conditional value '" + condition_val  + "' on line number " + ( i + 1 ) + ". Please user another value.";
			return false;
		}

	}

	return true;
}

//check (case condition value) if it matches the (switch's condition value)
function check_case_and_switch_data_types_match ( statement, linenum, array ) {

	//get the the data type of the case conditional value
	case_condition_val = statement.replace( /^case\s+([^:]+)\s*:$/, '$1' );
	case_data_type = get_constant_data_type( case_condition_val );

	switch_param_val = "";
	switch_line_num = 0;
	for ( var i = parseInt( linenum ) - 1; i >= 0; i-- ) {
		cur_val = array [ i ].trim();
		if ( cur_val.match( /^switch\s*\([^)]+\)\s*{$/ ) ) {
			switch_param_val = cur_val.replace( /^switch\s*\(([^)]+)\)\s*{$/, '$1' ).trim();
			switch_line_num = i;
			break;
		}
	}

	if( switch_param_val != "" ) {
		switch_data_type = get_indentifier_data_type( switch_param_val, switch_line_num, array );

		if ( switch_data_type != case_data_type ) {
			line_error = "Invalid data type of operand '" + case_condition_val + "' on line number " + ( parseInt( linenum ) + 1 ) + ". Required: " + switch_data_type + ".";
			return false;
		}

	} else {
		line_error = "Cannot find parent switch of the statement on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}


	return true;

}

//check if the declared integer var in the loop is redundant
function check_forloop_var_dec_unique ( str, linenum, array ) {
	loop_int_var = str.replace( /^for\s*\(\s*int\s([A-z][A-z0-9]?)\s*=\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1\s*(?:==|!=|>|<|>=|<=)\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1([\-+]{2})\s*\)\s*{$/, '$1' );
	
	//loop through the previous values
	for ( var i = linenum - 1 ; i >= 0; i-- ) {
		line_str = array [ i ]; 

		//check if for loop param initialization variable has been declared already
		if ( line_str.match( /^(?:int|double|float|String|char|boolean)\s/ ) ) {
			prev_var = line_str.replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" );
			if ( loop_int_var == prev_var ) {
				line_error = "Variable '" + loop_int_var + "' on line number " + ( parseInt( linenum ) + 1 ) + " already in use.";
				return false;
			}	
		}

		//check if for loop param initialization variable is available for usage
		else if ( line_str.match( /^for/ ) ) {
			prev_var = line_str.replace( /^for[ ]*[(][ ]*int\s+([A-z][A-z0-9]?)\s.+$/, "$1" );

			if ( is_variable_accessible ( prev_var, linenum, array ) ) {

				if ( loop_int_var == prev_var ) {
					line_error = "Variable '" + loop_int_var + "' on line number " + ( parseInt( linenum ) + 1 ) + " already in use.";
					return false;
				}
			}

		}
			

		
																			
	}

	return true;
}

//check if the identifiers/constants used in the foor loop are integers
function check_identifiers_and_constants_integer ( str, linenum, array ) {
	//get the parameter line
	parameter_line = str.replace( /^(?:System\.out\.print(?:ln)?|if|else if|switch|for|(?:\}\s*)?while)\s*\(([^)]*)\)(?:;|\s*\{)|(case\s+[^:]):$/, "$1" ).trim();
		
	//replace everything in the forloop condition apart from $2 and $3 => (int a = $2; a < $3; a++) 
	input_values = parameter_line.replace( /^int\s([A-z][A-z0-9]?)\s*=\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1\s*(?:==|!=|>|<|>=|<=)\s*([A-z][A-z0-9]?|[0-9]{1,9})\s*;\s*\1([\-+]{2})$/, "$2 $3" );

	//put the input values in an array
	operands = input_values.match( /([A-z][A-z0-9]?|[0-9]{1,9})/g );

	for ( var i in operands ) {
		var operand = operands [ i ];

		//constant
		if ( operand.match( /[0-9]{1,9}/ ) ) {
			data_type = get_constant_data_type ( operand );
		
		//identifier
		} else if ( operand.match( /[A-z][A-z0-9]?/ ) ) {
			data_type = get_indentifier_data_type ( operand, linenum, array );
		}

		if ( data_type != 'int' ) {
			line_error = "Invalid data type of operand '" + operand + "' on line number " + ( parseInt( linenum ) + 1 ) + ". Found: " + data_type + ". Required: int.";
			return false;
		}

	}


	return true;
}