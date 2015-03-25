var user_input_structure = "";
var tab_n = 0; //number of tabs in the output

//translate
function translateTags ( tag_array ) {
	var code_fragment = "";
	user_input_structure = "";
	


	for ( var x in tag_array ) {
		tag = tag_array[ x ];
			
		//conditional structures
		if( tag.match( /^(?=<(div|span)\s+class="(if|elseif|else|switch|case|casedefault).*")/ ) ) {
			
			code_fragment += returnTabs( tab_n ) + getConditionalExp( tag );
			tab_n++;//increment tab # for output
		} else if ( tag.match( /^(?=<div\s+class="(endif|endelse|endelseif|endswitch|endwhile|endforloop).*")/ ) ) { //closing bracket
			tab_n--;//decrement tab # for output
			code_fragment += returnTabs( tab_n ) + "}\n";

			user_input_structure += "}"; //add to user pattern

		} else if ( tag.match( /^(?=<div\s+class="(endcase|endcasedefault).*")/ ) ) {
			tab_n--;//decrement tab # for output
			code_fragment += returnTabs( tab_n ) + "break;\n";

			user_input_structure += "}"; //add to user pattern

		} else if ( tag.match( /^<div\s+class="println"/ ) ) { //print
			code_fragment += returnTabs( tab_n ) + getPrintStatementEquivalent( tag );
			user_input_structure += "PL;";
		} else if ( tag.match( /^<div\s+class="variable"\s+datatype="(int|double|float|String|char|boolean)"/ ) ) { //variable
			code_fragment += returnTabs( tab_n ) + getVariableEquivalent( tag );
		} else if ( tag.match( /^(?=<div\s+class="(while|dowhile|forloop)\b.*")/ ) ) { //repetition
			code_fragment += returnTabs( tab_n ) + getRepetitionStmt( tag ); 
			tab_n++;//increment tab # for output
		} else if ( tag.match( /^(?=<div\s+class="enddowhile.*")/ ) ) {
			tab_n--;//decrement tab # for output
			code_fragment += returnTabs( tab_n ) + getRepetitionStmt( tag ); 

			user_input_structure += "}"; //add to user pattern
		} else if ( tag.match( /^(?=<div\s+class="(while_counter).*")/ ) ) { //counter
			code_fragment += returnTabs( tab_n ) + tag.replace( /^<div\s+class="while_counter"\s+value="([^")]*)".*>$/, '$1\n' );
		}
	}

	return code_fragment;
}

//return println statement
function getPrintStatementEquivalent ( tag ) {
	return tag.replace( /^<div\s+class="println"\s+val="([^"]*)".*>$/, "System.out.println( $1 );\n" );
} 

//matching if,elseif,else,switch,case
function getConditionalExp( tag ) {
	
	if ( tag.match( /^<div\s+class="if[A-z\ ]*"\s+condition="[^"]+".*>$/ ) ) {
		
		//translate to a statement
		str = tag.replace( /^<div\s+class="if[A-z\ ]*"\s+condition="([^"]+)".*>$/, "if ( $1 ) {\n" );

		user_input_structure += "IS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="elseif[A-z\ ]*"\s+condition="[^"]+".*>$/ ) ) { 
		str = tag.replace( /^<div\s+class="elseif[A-z\ ]*"\s+condition="([^"]+)".*>$/, "else if ( $1 ) {\n" );
	
		user_input_structure += "EIS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="else"[^>]*>$/ ) ) {
		str = "else {\n";
		
		user_input_structure += "ES{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="switch[A-z\ ]*"\s+param="[^")]*".*>$/ ) ) {
		tab_n--;
		str = tag.replace( /^<div\s+class="switch[A-z\ ]*"\s+param="([^")]*)".*>$/, "switch ( $1 ) {\n" );
		
		user_input_structure += "SS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="case[A-z\ ]*"\s+case="[^"]+".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="case[A-z\ ]*"\s+case="([^"]+)".*>$/, "case $1:\n" );
		//convert '[\w\s]+' to "$1"
		str = str.replace( /'([\w\s]{2,})'/, '"$1"' );
		
		user_input_structure += "CS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="casedefault[A-z\ ]*".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="casedefault[A-z\ ]*".*>$/, "default:\n" );
		
		user_input_structure += "CDS{"; //add to user pattern

	} else str = "";

	return str;
} 

//returns the variable syntax equivalent
function getVariableEquivalent ( tag ) {

	//String
	if ( tag.match( /^<div\s+class="variable"\s+datatype="String"\s+identifier="[A-z][A-z0-9]?"\s+val="([^\"]+)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(String)"\s+identifier="([A-z][A-z0-9]?)"\s+val="([^\"]+)".*>$/, '$1 $2 = "$3";\n' );
		user_input_structure += "VS;"; //add to user pattern
	}
	//char
	else if ( tag.match( /^<div\s+class="variable"\s+datatype="char"\s+identifier="[A-z][A-z0-9]?"\s+val="([^\"]+)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(char)"\s+identifier="([A-z][A-z0-9]?)"\s+val="([^\"]+)".*>$/, '$1 $2 = \'$3\';\n' );
		user_input_structure += "VC;"; //add to user pattern
	}
	//integer
	else if ( tag.match( /^<div\s+class="variable"\s+datatype="int"\s+identifier="[A-z][A-z0-9]?"\s+val="([^\"]+)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(int)"\s+identifier="([A-z][A-z0-9]?)"\s+val="([^\"]+)".*>$/, '$1 $2 = $3;\n' );
		user_input_structure += "VI;"; //add to user pattern
	}
	//double
	else if ( tag.match( /^<div\s+class="variable"\s+datatype="double"\s+identifier="[A-z][A-z0-9]?"\s+val="([^\"]+)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(double)"\s+identifier="([A-z][A-z0-9]?)"\s+val="([^\"]+)".*>*>$/, '$1 $2 = $3;\n' );
		user_input_structure += "VD;"; //add to user pattern
	}
	//float
	else if ( tag.match( /^<div\s+class="variable"\s+datatype="float"\s+identifier="[A-z][A-z0-9]?"\s+val="([^\"]+)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(float)"\s+identifier="([A-z][A-z0-9]?)"\s+val="([^\"]+)".*>$/, '$1 $2 = $3;\n' );
		user_input_structure += "VF;"; //add to user pattern
	}
	//boolean
	else if ( tag.match( /^<div\s+class="variable"\s+datatype="boolean"\s+identifier="[A-z][A-z0-9]?"\s+val="(true|false)".*>$/ ) ) {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="(boolean)"\s+identifier="([A-z][A-z0-9]?)"\s+val="(true|false)".*>$/, '$1 $2 = $3;\n' );
		user_input_structure += "VB;"; //add to user pattern
	} 
	//rubbish
	else {
		str = tag.replace( /^<div\s+class="variable"\s+datatype="([^"]*)"\s+identifier="([^"]*)"\s+val="([^"]*)"[^>]+>$/, '$1 $2 = $3;\n' );
		user_input_structure += "RS;"; //add to user pattern
	}

	return str;

}

//match while, do, & for
function getRepetitionStmt( tag ) {
	
	if ( tag.match( /^<div\s+class="while[A-z\ ]*"\s+condition="[^"]+".*>$/ ) ) {
		
		//translate to a statement
		str = tag.replace( /^<div\s+class="while[A-z\ ]*"\s+condition="([^"]+)".*>$/, "while ( $1 ) {\n" );

		user_input_structure += "WS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="forloop[A-z\ ]*"\s+condition="[^"]+".*>$/ ) ) {
		
		//translate to a statement
		str = tag.replace( /^<div\s+class="forloop[A-z\ ]*"\s+condition="([^"]+)".*>$/, "for ( $1 ) {\n" );

		user_input_structure += "FS{"; //add to user pattern

	} else if ( tag.match( /^<div\s+class="dowhile[A-z\ ]*".*>$/ ) ) {
		str = "do {\n";

		user_input_structure += "DWS{"; //add to user pattern
	} else if ( tag.match( /^<div\s+class="enddowhile[A-z\ ]*"\s+condition="([^"]+)".*>$/ ) ) {
		//translate to a statement
		str = tag.replace( /^<div\s+class="enddowhile[A-z\ ]*"\s+condition="([^"]+)".*>$/, "} while ( $1 );\n" );
	}
	else str = "";

	return str;
}

//remove the spaces before and after the tags
function filterTags( tag_array ) {
	var tag_filtered = [];
	
	for ( var x in tag_array ) {
		val = tag_array [ x ];
		if ( ! val.match( /^\s+$/ ) && val != '' ) {
			tag_filtered.push( val.replace( /^\s+/, "" ).replace().replace( /\s+$/, "" ) + ">" ); 
		}
	}

	return tag_filtered;
}

//return tabs
function returnTabs ( n ) {
	str = "";
	for ( x = 0; x < n; x++ ) {
		str += "\t";
	}
	return str;
}

//return the user structural input pattern
function getUserInputStructure () {
	return user_input_structure;
}