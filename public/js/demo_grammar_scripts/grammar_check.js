var generated_codes_arr = [ 
	'int a = 1;',
	'double c = 2.2;',
	'int b = 1;', 
	'if ( a != c ) {', 
	'	System.out.println( "They are equal" );', 
	'}',
	'switch ( a ) {',
	'	case 1:',
	'	break;',
	'}' 
];
var line_error = "";
var code_validity = true;

$( document ).ready( function () {
	//if ( ! lexical_anaylize( generated_codes_arr ) ) return;
	//console.log( "fine" );
} );

function grammmar_check ( generated_codes_arr ) {

	code_validity = lexical_anaylize( generated_codes_arr );

	if ( ! code_validity ) console.log( get_grammar_error() );
	else console.log( "fine" );

	return code_validity;
}

//return
function get_grammar_error () {
	return line_error;
}
