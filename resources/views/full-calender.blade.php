<!DOCTYPE html>
<html>
<head>
    <title>How to Use Fullcalendar in Laravel 8</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
</head>
<body>
  
<div class="container">
    <br />
    <h1 class="text-center text-primary"><u>MURAL - CALENDÁRIO</u></h1>
    <br />

    <div id="calendar"></div>

</div>
   
<script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calender',
        selectable:true,
        selectHelper: true,
        select:function(inicio, fim, allDay)
        {
            var titulo = prompt('Event Title:');

            if(titulo)
            {
                var inicio = $.fullCalendar.formatDate(inicio, 'DD-MM-Y HH:mm:ss');

                var fim = $.fullCalendar.formatDate(fim, 'DD-MM-Y HH:mm:ss');

                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        titulo: titulo,
                        inicio: inicio,
                        fim: fim,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                })
            }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var inicio = $.fullCalendar.formatDate(event.inicio, 'DD-MM-Y HH:mm:ss');
            var fim = $.fullCalendar.formatDate(event.fim, 'DD-MM-Y HH:mm:ss');
            var titulo = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    titulo: titulo,
                    inicio: inicio,
                    fim: fim,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var inicio = $.fullCalendar.formatDate(event.inicio, 'DD-MM-Y HH:mm:ss');
            var fim = $.fullCalendar.formatDate(event.fim, 'DD-MM-Y HH:mm:ss');
            var titulo = event.titulo;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    titulo: titulo,
                    inicio: inicio,
                    fim: fim,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }
    });

});
  
</script>
  
</body>
</html>