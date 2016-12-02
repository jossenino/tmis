$(function(){

    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event
	var events = [];
    var id = [];
    var title = [];
    var start = [];
    var end = [];
    var description = [];
    var color = [];
    var currentMousePos = {
        x: -1,
        y: -1
    };
        jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

    $('#color').colorpicker(); // Colopicker
    $('#color2').colorpicker(); // Colopicker
    $('#time').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: true,
        showMeridian: false
    });  // Timepicker

    var base_url='http://tmis.com.ve/TMIS/public_html/index.php/menu/'; // Here i define the base_url

    // Fullcalendar
    $('#calendar').fullCalendar({
        timeFormat: 'H(:mm)',
        lang: 'es',
        header: {
            left: 'prev, next, today',
            center: 'title',
             right: 'month, basicWeek, agendaDay, listWeek'
        },
        // Get all events stored in database
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: base_url+'calendar/getEvents',

        // Handle Day Click
        dayClick: function(date, event, view) {
            currentDate = date.format();
            // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-success', // Buttons class
                        label: 'Add' // Buttons label
                    }
                },
                title: 'Add Event (' + date.format() + ')' // Modal title
            });
        },
   
          editable: true, // Make the event draggable true 
         eventDrop: function(event, delta, revertFunc) {  

            
               $.post(base_url+'calendar/dragUpdateEvent',{                            
                id:event.id,
                date: event.start.format()
            }, function(result){
                if(result)
                {
                alert('Updated');
                }
                else
                {
                    alert('Try Again later!')
                }

            });



          },
        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view){

            var tooltip = '<div class="event-tooltip">' + calEvent.title + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;

            // Open modal to edit or delete event
            modal({
                // Available buttons when editing
                buttons: {
                    delete: {
                        id: 'delete-event',
                        css: 'btn-danger',
                        label: 'Delete'
                    },
                    update: {
                        id: 'update-event',
                        css: 'btn-success',
                        label: 'Update'
                    }
                },
                title: 'Edit Event "' + calEvent.title + '"',
                event: calEvent
            });
        },
        eventDrop: function(event, delta, revertFunc) {
            var start = event.start.format();
            var end = (event.end == null) ? start : event.end.format();
            $.post(base_url+'calendar/updateEvent', {
                id: event.id,
                title: event.title,
                description: event.description,
                color: event.color,
                date: start,
                endDate: end,
            }, function(result){
                alert("Modificación éxitosa");
                $('#calendar').fullCalendar("refetchEvents");
            });
        },
        eventResize: function(event, delta, revertFunc) {
            $.post(base_url+'calendar/updateEvent', {
                id: event.id,
                title: event.title,
                description: event.description,
                color: event.color,
                date: event.start.format(),
                endDate: event.end.format(),
            }, function(result){
                alert("Modificación éxitosa");
                $('#calendar').fullCalendar("refetchEvents");
            });
        },
        eventDragStop: function (event, jsEvent, ui, view) {
            if (isElemOverDiv()) {
                var con = confirm('Estás seguro? El evento se eliminara permanentemente');
                if(con == true) {
                    $.get(base_url+'calendar/deleteEvent?id=' + event.id, function(result){
                        $('#calendar').fullCalendar("refetchEvents");
                    });
                }   
            }
        }
    });

    // Prepares the modal window according to data passed
    function modal(data) {
        // Set modal title
        $('.modal-title').html(data.title);
        // Clear buttons except Cancel
        $('.modal-footer button:not(".btn-default")').remove();
        // Set input values
        $('#title').val(data.event ? data.event.title : '');
        if( ! data.event) {
            // When adding set timepicker to current time
            var now = new Date();
            var time = now.getHours() + ':' + (now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes());
        } else {
            // When editing set timepicker to event's time
            var time = moment(data.event.start).format("YYYY-MM-DD HH:mm:ss");
        }
        $('#time').val(time);
        $('#description').val(data.event ? data.event.description : '');
        $('#color').val(data.event ? data.event.color : '#3a87ad');
        $('#endDate').val(data.event ? moment(data.event.end).format("YYYY-MM-DD HH:mm:ss") : '');
        // Create Butttons
        $.each(data.buttons, function(index, button){
            $('#Calendarmodal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>') 
        })
        //Show Modal
        $('#modalCalendar').modal('show');
    }

    // Handle Click on Add Button
    $('#modalCalendar').on('click', '#add-event',  function(e){
        $.post(base_url+'calendar/addEvent', {
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            date: currentDate + ' ' + getTime(),
            endDate: $('#endDate').val(),
            url: $('#url').val(),
            typeEvent: $('select[name=typeEvent]').val(),
            status: 1,
        }, function(result){
            $('#modalCalendar').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            alert("El evento se creo exitosamente");
        });
    });


    // Handle click on Update Button
    $('#modalCalendar').on('click', '#update-event',  function(e){
        $.post(base_url+'calendar/updateEvent', {
            id: currentEvent._id,
            title: $('#title').val(),
            description: $('#description').val(),
            color: $('#color').val(),
            date: moment(currentEvent.start).format("YYYY-MM-DD HH:mm:ss"),
            endDate: $('#endDate').val(),
            url: $('#url').val(),
            typeEvent: $('select[name=typeEvent]').val(),
            status: 1
        }, function(result){
            $('#modalCalendar').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
        });
    });



    // Handle Click on Delete Button
    $('#modalCalendar').on('click', '#delete-event',  function(e){
        $.get(base_url+'calendar/deleteEvent?id=' + currentEvent._id, function(result){
            $('#modalCalendar').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
        });
    });


    // Get Formated Time From Timepicker
    function getTime() {
        var time = $('#time').val();
        return (time.indexOf(':') == 1 ? '0' + time : time) + ':00';
    }

    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Please insert title and description');
            return false;
        }
        return true;
    }

    function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }
});