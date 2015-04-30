$( document ).ready( function () {
    
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    setInterval(function () {
        moveRight();
    }, 5000 );

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 1, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

} );

