var line_error = "";
var data_type_in_current_line = "";

//check print statement
function check_print_statement ( str, linenum, statements_arr ) {
	if ( ! check_print_statement_value ( str, linenum, statements_arr ) ) return false;

	return true;
}

//check the value
function check_print_statement_value ( str, linenum, statements_arr ) {
		
	//Supported: Int, double, String, char	
	if ( str.match( /^System\.out\.print(?:ln)?\(\s*(?:null|[A-z][A-z0-9]*|"[^"]{0,50}"|'[^']'|(?:[0-9]{1,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2})|[0-9]{1,9})\s*\);$/ ) ) return true;
	
	line_error = "Invalid parameter in print statement on line number " + ( parseInt( linenum ) + 1 ) + ".";
	return false;

}