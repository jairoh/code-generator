var line_error = "";
var data_type_in_current_line = "";

//check type of statement to determine what rules to use
function check_type_of_statement ( str, linenum ) {
	var type_of_cond = str.replace( /^\b(if|else if|switch|case|while)\b.*$/, '$1' );

	if ( str.match( /^(if|else if|while)\s/ ) ) {

		if ( ! check_parens_found ( str, linenum ) ) return false;
		if ( ! check_expressions_valid ( str, linenum, type_of_cond )  ) return false;

	} else if ( str.match( /^switch\s/ ) ) {

		if ( ! check_parens_found ( str, linenum ) ) return false;
		if ( ! check_expressions_valid ( str, linenum, type_of_cond )  ) return false;

	} else if ( str.match( /^case\s/ ) ) {
		
		if ( ! check_colon_present ( str, linenum ) ) return false;
		if ( ! check_expressions_valid ( str, linenum, type_of_cond )  ) return false;
	
	}

	return true;
}

//check if the two parentheses are found
function check_parens_found ( str, linenum ) {
	if ( ! str.match( /^(?:if|else if|switch|while)\s+\(/ ) ) {
		line_error = "Cannot find '(' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else if ( ! str.match( /^(?:if|else if|switch|while)\s+\(.+\)(?!\))/ ) ) {
		line_error = "Cannot find ')' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else if ( ! str.match( /^[^{]+\{/ ) ) {
		line_error = "Cannot find '{' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}
	return true;
}

//check if colon is present in the endline
function check_colon_present ( str, linenum ) {
	if ( ! str.match( /^[^{]+:/ ) ) {
		line_error = "Cannot find ':' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	}

	return true;
}

//check if the expressions are valid
//NOTE: <const> has no (long|short|float|byte)
function check_expressions_valid ( str, linenum, type_of_cond ) {
	
	//replace &quot; with "
	str = str.replace( /&quot;/g, '"' );


	if ( type_of_cond.match( /^(if|else if|while)$/ ) ) {
		

		//keyword( true | false )
		if ( str.match( /^(?:if|else if|while)\s*\(\s*(?:true|false)\s*\)\s*{$/ ) )return true;
		
		//keyword( <identifier> <rel_op> <identifier> )
		else if ( str.match( /^(?:if|else if|while)\s*\(\s*(?:null|[A-z][A-z0-9]?)\s*(?:==|!=|>|<|>=|<=)\s*(?:null|[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) return true;

		//keyword( <const> <rel_op> <identifier> ) 
		else if ( str.match( /^(?:if|else if|while)\s*\(\s*(?:null|true|false|"[A-z0-9.,!? ]*"|'[A-z0-9.,!? ]'|(?:[0-9]{1,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2})|[0-9]{1,9})\s*(?:==|!=|>|<|>=|<=)\s*(?:null|"[A-z0-9.,!? ]*"|'[A-z0-9.,!? ]'|(?:[0-9]{1,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2})|[0-9]{1,9})\s*\)\s*{$/ ) ) return true;

		//keyword( <identifier> <rel_op> <const> )	
		else if ( str.match( /^(if|else if|while)\s*\(\s*(?:null|"[^"]{0,10}"|'[^']'|(?:[0-9]{0,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2})|[0-9]{1,9})\s*(?:==|!=|>|<|>=|<=)\s*(?:null|true|false|[A-z][A-z0-9]?)\s*\)\s*{$/ ) ) return true;
		
		//keyword( <const> <rel_op> <const> )
		else if ( str.match( /^(if|else if|while)\s*\(\s*(?:null|true|false|[A-z][A-z0-9]?)\s*(?:==|!=|>|<|>=|<=)\s*(?:null|true|false|"[^"]{0,10}"|'[^']'|(?:[0-9]{1,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2})|[0-9]{1,9})\s*\)\s*{$/ ) ) return true;


		else {
			line_error = "Invalid parameters on line number " + ( parseInt( linenum ) + 1 ) + ".";
			return false;
		}	
		
	} else if ( type_of_cond.match( /^switch$/ ) ) {

		//keyword( <identifier> )
		if ( str.match( /^switch\s*\(\s*(?:null|[A-z][A-z0-9]?)\s*\)\s*{/ ) ) return true;

		else {
			line_error = "Invalid parameters on line number " + ( parseInt( linenum ) + 1 ) + ". Required: one identifier.";
			return false;
		}	

	} else if ( type_of_cond.match( /^case$/ ) ) {

		//support: String, int, char
		if ( str.match( /^case\s(?:[0-9]{1,9}|"[^"]{1,10}"|'[^']')\s*:$/ ) ) return true;

		else {
			line_error = "Invalid parameter on case statement on line number " + ( parseInt( linenum ) + 1 ) + ".";
			return false;
		}


	}

	
	return true;

}

