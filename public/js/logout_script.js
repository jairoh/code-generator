function do_logout () {
	localStorage.setItem( 'current_structure', '' );
    window.location.href= $( '#root_path' ).val() + "logout";
}