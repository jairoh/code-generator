var execute_results_arr = {
	warnings : "",
	errors : "",
	stats : "",
	files : "",
	result : ""
};

// Make the actual CORS request.
function makeCorsRequest( method, url, formData ) {
	//clear before using
	execute_results_arr = {
		warnings : "",
		errors : "",
		stats : "",
		files : "",
		result : ""
	};
	
	var xhr = createCORSRequest( method, url );
	if (!xhr) {
		alert('CORS not supported');
		return;
	}

	//send post request with data
	xhr.send( formData );

	// Response handlers.
	xhr.onload = function() {
		var json = eval("(" + xhr.responseText + ")");
		//console.log( json );
		
		//put the results in an array
		execute_results_arr = {
			warnings : json.Warnings,
			errors : json.Errors,
			stats : json.Stats,
			files : json.Files,
			result : json.Result
		};

		//call generate.js showResult()
		showResult( true );

	};

	xhr.onerror = function() {
		//alert( 'Woops, there was an error making the CORS request.' );
		
		//call generate.js showResult()
		showResult( false );
	};

}


// Create the XHR object.
function createCORSRequest( method, url) {
  var xhr = new XMLHttpRequest();
  if ("withCredentials" in xhr) {
    // XHR for Chrome/Firefox/Opera/Safari.
    xhr.open(method, url, true);
  } else if (typeof XDomainRequest != "undefined") {
    // XDomainRequest for IE.
    xhr = new XDomainRequest();
    xhr.open(method, url);
  } else {
    // CORS not supported.
    xhr = null;
  }
  return xhr;
}
