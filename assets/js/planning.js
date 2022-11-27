if (document.getElementById('calendar')) {

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
                locale: 'fr',
                timezone: 'Europe/Paris',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    week: 'Semaine',
                    day: 'Jour',
                },
              
        });
        calendar.render();
      });
    
      console.log(data);

      
    // window.onload = () => {
    //     let calendarElt = document.getElementById('calendar');
    //     let calendar = new FullCalendar.Calendar(calendarElt, {
    //         initialView: 'timeGridWeek',
    //         locale: 'fr',
    //         timezone: 'Europe/Paris',
    //         headerToolbar: {
    //             start: 'prev,next today',
    //             center: 'title',
    //             end: 'timeGridWeek,timeGridDay'
    //         },
    //         buttonText: {
    //             today: 'Aujourd\'hui',
    //             week: 'Semaine',
    //             day: 'Jour',
    //         },
            
    //     });
    //     calendar.on('eventChange', (e) => {
    //         let url = `/api/${e.event.id}/edit`
    //         let data = {
    //             "title": e.event.title,
    //             "description": e.event.extendedProps.description,
    //             "start": e.event.start,
    //             "end": e.event.end,
    //             "backgroundColor": e.event.backgroundColor,
    //             "allDay": e.event.allDay,
    //         }
    //         console.log(data);
    //     let xhr = new XMLHttpRequest
    //     xhr.open("PUT", url)
    //     xhr.send(JSON.stringify(data))
    //     })
    //     calendar.render();
    // };
}
