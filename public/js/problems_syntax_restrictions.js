var line_error = "";

//check if there is a comparison between two identitifiers; and the identifiers must not be the same
function E_Prob_1_res ( statements_arr ) {

	for ( var i in statements_arr ) {

		//check if there is a comparison between two identitifiers;
		if ( statements_arr [ i ].trim().match( /^if\s*\(\s*[A-z][A-z0-9]?\s*(?:==|!=|>|<|>=|<=)\s*[A-z][A-z0-9]?\s*\)\s*{$/ ) ) {
			
			//and w/ the identifiers must not be the same
			if ( statements_arr [ i ].trim().match( /^if\s*\(\s*([A-z][A-z0-9]?)\s*(?:==|!=|>|<|>=|<=)\s*\b(?!\1).{1,2}\b\s*\)\s*{$/ ) ) {
				return true;
			}
			
		}
			
	}

	line_error = "Cannot find conditional comparison between 2 identifiers.";
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
		line_error = "Cannot find conditional comparison of the initialized variable less than 75.";
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
		line_error = "Cannot find conditional comparison of the initialized variable greater than or equal to 75.";
		return false;
	}

	
	return found;
}