var line_error = "";
var data_type_in_current_line = "";

//check variable declaration
function check_var_dec ( str, linenum ) {
	
	if ( ! check_terminator_found ( str, linenum ) ) return false;
	if ( ! check_data_type ( str, linenum ) ) return false;
	if ( ! check_identifier ( str, linenum ) ) return false;
	if ( ! check_equal_sign ( str, linenum ) ) return false;
	if ( ! check_variable_value ( str, linenum, data_type_in_current_line ) ) return false;
	return true;
}

//check if the data type is valid
function check_data_type ( str, linenum ) {
	if ( ! str.match( /^\b(?:int|double|float|String|char|boolean)\b/ ) ) {
		line_error = str + " → Invalid data type on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else { 
		data_type_in_current_line = str.replace( /^\b(int|double|float|String|char|boolean)\b.+$/, "$1" );
		return true;
	}
}

//check ';' found
function check_terminator_found ( str, linenum ) {
	if ( ! str.match( /^[^;]+;$/ ) ) {
		line_error = "Cannot find ';' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else return true;
}

//check if the identifier is valid
function check_identifier ( str, linenum ) {
	if ( ! str.match( /^\b(?:int|double|float|String|char|boolean)\b\s+\b[A-z][A-z0-9]?\b/ ) ) {
		var value = str.replace( /^\b(?:int|double|float|String|char|boolean)\b\s+\b([A-z0-9]+)?\b.+$/, "$1" );
		line_error = "Invalid identifier \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else return true;
}

//check if equal sign is found after the identifier
function check_equal_sign ( str, linenum ) {
	if ( ! str.match( /^\b(int|double|float|String|char|boolean)\b\s+\b[A-z][A-z0-9]?\b\s+=\s/ ) ) {
		line_error = "Cannot find valid '=' on line number " + ( parseInt( linenum ) + 1 ) + ".";
		return false;
	} else return true;
}

//check the value depending on the data type
function check_variable_value ( str, linenum, data_type ) {
	var value = str.replace( /^(?:int|double|float|String|char|boolean)\s+[A-z][A-z0-9]?\s*=\s*(.+);$/, "$1" );

	switch ( data_type ) {
		case "int":
			if ( ! str.match( /^\bint\b\s+\b[A-z][A-z0-9]?\b\s+=\s+[0-9]{1,9};$/ ) ) {
				line_error = "Invalid value \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ". Required: Integer.";
				return false;
			} else return true;
		break;
		case "double":
			if ( ! str.match( /^\bdouble\b\s+\b[A-z][A-z0-9]?\b\s+=\s+(([0-9]{1,9}\.[0-9]{0,2})|([0-9]{0,9}\.[0-9]{1,2}));$/ ) ) {
				line_error =  "Invalid value \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ". Required: double.";
				return false;
			} else return true;
		break;
		case "String":
			if ( ! str.match( /^\bString\b\s+\b[A-z][A-z0-9]?\b\s+=\s+("[^"]{0,50}");$/ ) ) {
				line_error =  "Invalid value \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ". Required: String.";
				return false;
			} else return true;
		break;
		case "char":
			if ( ! str.match( /^\bchar\b\s+\b[A-z][A-z0-9]?\b\s+=\s+('[^']');$/ ) ) {
				line_error =  "Invalid value \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ". Required: char.";
				return false;
			} else return true;
		break;
		case "boolean":
			if ( ! str.match( /^\bboolean\b\s+\b[A-z][A-z0-9]?\b\s+=\s+(true|false);$/ ) ) {
				line_error =  "Invalid value \"" + value + "\" on line number " + ( parseInt( linenum ) + 1 ) + ". Required: boolean.";
				return false;
			} else return true;
		break;
		//long

		//short

		//float

		//byte
	}
}