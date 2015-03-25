$( document ).ready( function () {
	  
   var startDate;
   var endDate;
    
    var selectCurrentWeek = function() {
        window.setTimeout(function () {
            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }
    
    $('.week-picker').datepicker( {
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
           // var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
           //$('#startDate').text($.datepicker.formatDate( "yy-mm-dd", startDate, inst.settings ));
          //$('#endDate').text($.datepicker.formatDate( "yy-mm-dd", endDate, inst.settings ));
            
            selectCurrentWeek();
            
            //relocate with date param
            setTimeout( function () {
                window.location = $( '#root_path' ).val() + 'ranking/' + $.datepicker.formatDate( "yy-mm-dd", startDate, inst.settings );
            }, 500 );
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function(year, month, inst) {
            selectCurrentWeek();
        }
    }).hide();
    
/*    $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });*/


    $( '#pick_week' ).click( function () {
        $('.week-picker').show();
    } );

} );

//send request display with date
function display_list_with_specified_week ( date ) {
}