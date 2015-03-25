
$(function(){
    
    $('body').prepend('<div id="shadow_box"></div>');

    $(this).keyup(function(e){
        if(e.keyCode==27){
            if($('.popup_box').is(':visible')){
                close_box();
            }
        }
    });

    $('.popup_box').draggable();

});


function show_popup(box_id,popup_title){
    
    $('.close_icon').remove();
    $('.popup_title').remove();
    $(box_id).prepend('<span title="Close" class="close_icon" onclick="close_box();">x</span><p class="popup_title">'+popup_title+'</p>');
    $('#shadow_box').show();
    center_box('#shadow_box',box_id);
    
}//end of show_popup

function center_box(shadow_id,box_id){
    
	
	$(box_id).css({
	    position:'fixed',
		left:($(shadow_id).width() - $(box_id).outerWidth())/2,
		top:($(shadow_id).height() - $(box_id).outerHeight())/2,	
	});
	
	$(box_id).show();
	

}//end of center_box

function close_box(){
    $('#shadow_box').hide();
    $('.popup_box').hide();
}//end of close_box

function load_content(){
    $('#shadow_box').show();
    center_box('#shadow_box','#load_img');
}///end of load_content

function close_load_content(){
    $('#shadow_box').hide();
    $('#load_img').hide();
}
