$( document ).ready( function () {

	//update user profile script
	$( '#update_profile_btn' ).click( function () {
		
		var firstname = $( "#update_fn" ).val();
		var lastname = $( "#update_ln" ).val();
		var email = $( "#update_email" ).val();
		var gender_id = ( $('input[name=update_gender]:checked').val() );
		var msg = "You sure to save this profile?";

		$.ajax( {
			type: 'POST',
			url: $( '#root_path' ).val() +'profile/do_profile_update',
			data: {
				firstname : firstname,
				lastname : lastname,
				email : email,
				gender : gender_id
			}, success: function ( e ) {
				if ( e != "saved" ) {
					$( "#update_errors" ).html( e );
				} else {
					window.location.reload( true );
				}
			}, error: function ( jqXHR, exception ) {
				if (jqXHR.status === 0) {
			        alert ('Not connected.\nPlease verify your network connection.');
			    } else if (jqXHR.status == 404) {
			        alert ('The requested page not found. [404]');
			    } else if (jqXHR.status == 500) {
			        alert ('Internal Server Error [500].');
			    } else if (exception === 'parsererror') {
			        alert ('Requested JSON parse failed.');
			    } else if (exception === 'timeout') {
			        alert ('Time out error.');
			    } else if (exception === 'abort') {
			        alert ('Ajax request aborted.');
			    } else {
			        alert ('Uncaught Error.\n' + jqXHR.responseText);
			    }
			}
		} );

		

		//disable reloading
		return false;
	} );


	//update user password
	$( '#update_password_btn' ).click( function () {
		
		var password = $( "#password" ).val();
		var password_confirmation = $( "#password_confirmation" ).val();

		$.ajax( {
			type: 'POST',
			url: $( '#root_path' ).val() + 'profile/do_password_update',
			data: {
				password : password,
				password_confirmation : password_confirmation
			}, success: function ( e ) {
				if ( e != "saved" ) {
					$( "#update_pass_errors" ).html( e );
				} else {
					window.location.reload( true );
				}
			}, error: function ( jqXHR, exception ) {
				if (jqXHR.status === 0) {
			        alert ('Not connected.\nPlease verify your network connection.');
			    } else if (jqXHR.status == 404) {
			        alert ('The requested page not found. [404]');
			    } else if (jqXHR.status == 500) {
			        alert ('Internal Server Error [500].');
			    } else if (exception === 'parsererror') {
			        alert ('Requested JSON parse failed.');
			    } else if (exception === 'timeout') {
			        alert ('Time out error.');
			    } else if (exception === 'abort') {
			        alert ('Ajax request aborted.');
			    } else {
			        alert ('Uncaught Error.\n' + jqXHR.responseText);
			    }
			}
		} );

		

		//disable reloading
		return false;
	} );

	

} );