var generated_codes_arr = [ 
	'int a = 1;', 
	'int b = 1;', 
	'if ( a==b ) {', 
	'	System.out.println( "They are equal" );', 
	'}' 
];

$( document ).ready( function () {
	console.log( check_var_dec ( "double a = 5;", 1 ) + "\n" + line_error + "\n" );
} );

var line_error = "";
var data_type_in_current_line = "";

//check variable declaration
function check_var_dec ( str, linenum ) {
	if ( ! check_data_type ( str, linenum ) ) return false;
	if ( ! check_identifier ( str, linenum ) ) return false;
	if ( ! check_equal_sign ( str, linenum ) ) return false;
	if ( ! check_variable_value ( str, linenum, data_type_in_current_line ) ) return false;
	return true;
}

//check if the data type is valid
function check_data_type ( str, linenum ) {
	if ( ! str.match( /^\b(?:int|double|float|String|char|boolean)\b/ ) ) {
		line_error = str + " → Invalid data type on line number " + linenum + ".";
		return false;
	} else { 
		data_type_in_current_line = str.replace( /^\b(int|double|float|String|char|boolean)\b.+$/, "$1" );
		return true;
	}
}

//check if the identifier is valid
function check_identifier ( str, linenum ) {
	if ( ! str.match( /^\b(?:int|double|float|String|char|boolean)\b\s+\b[A-z][A-z0-9]?\b/ ) ) {
		var value = str.replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z][A-z0-9]*)?\b.+$/, "$1" );
		line_error = "\"" + value + "\" → Invalid identifier on line number " + linenum + ".";
		return false;
	} else return true;
}

//check if equal sign is found after the identifier
function check_equal_sign ( str, linenum ) {
	if ( ! str.match( /^\b(int|double|float|String|char|boolean)\b\s+\b[A-z][A-z0-9]?\b\s+=\s/ ) ) {
		line_error = "\"" + str + "\" → Cannot find valid '=' on line number " + linenum + ".";
		return false;
	} else return true;
}

//check the value depending on the data type
function check_variable_value ( str, linenum, data_type ) {
	var value = str.replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b[A-z][A-z0-9]?\b\s+=\s+\b(.+)\b;$/, "$1" );

	switch ( data_type ) {
		case "int":
			if ( ! str.match( /^\bint\b\s+\b[A-z][A-z0-9]?\b\s+=\s+[0-9]{1,9};$/ ) ) {
				line_error = "\"" + value + "\" → Invalid integer value on line number " + linenum + ".";
				return false;
			} else return true;
		break;
		case "double":
			if ( ! str.match( /^\bdouble\b\s+\b[A-z][A-z0-9]?\b\s+=\s+([0-9]{1,9}\.[0-9]{0,2}|[0-9]{0,9}\.[0-9]{1,2});$/ ) ) {
				line_error =  "\"" + value + "\" → Invalid double value on line number " + linenum + ".";
				return false;
			} else return true;
		break;
		case "String":
			if ( ! str.match( /^\bString\b\s+\b[A-z][A-z0-9]?\b\s+=\s+("[A-z0-9.,!? ]*");$/ ) ) {
				line_error =  "'" + value + "' → Invalid String value on line number " + linenum + ".";
				return false;
			} else return true;
		break;
		case "char":
			if ( ! str.match( /^\bchar\b\s+\b[A-z][A-z0-9]?\b\s+=\s+('[A-z0-9.,!? ]');$/ ) ) {
				line_error =  "'" + value + "' → Invalid character value on line number " + linenum + ".";
				return false;
			} else return true;
		break;
		case "boolean":
			if ( ! str.match( /^\bboolean\b\s+\b[A-z][A-z0-9]?\b\s+=\s+(true|false);$/ ) ) {
				line_error =  "'" + value + "' → Invalid boolean value on line number " + linenum + ".";
				return false;
			} else return true;
		break;
		//long

		//short

		//float

		//byte
	}
}