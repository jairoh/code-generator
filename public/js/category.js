$(function() {
  $( "#dialog-confirm" ).hide();
});

function proceed_to_the_problem ( category_id, level ) {
  if ( category_id == 1 ) cat_name = "Easy";
  else if ( category_id == 2 ) cat_name = "Average";
  else if ( category_id == 3 ) cat_name = "Difficult";
  $( '#cat_name' ).html( cat_name );
  $( '#level' ).html( level );

  $( "#dialog-confirm" ).dialog({
    title: "Confirmation",
    resizable: false,
    height: 160,
    modal: true,
    position: [ 'middle', 200 ],
    buttons: {
      "Proceed": function() {
        localStorage.setItem( 'current_structure', '' );
       window.location.href= $( '#root_path' ).val() + "round/" + category_id + "/" + level ;
      },
      Cancel: function() {
        $( this ).dialog( "close" );
      }
    }
  });
}