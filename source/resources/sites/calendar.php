<div id='calendar'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $.ajax({
            type: "GET",
            url: "api/todos",
            // The key needs to match your method's input parameter (case-sensitive).
            contentType: "application/json",
            dataType: "json",
            success: function(response) {
                var data = response.data;
                var todos = data.map(function(todo) {
                    return {
                        "title": todo.name,
                        "start": todo.start_date,
                        "end": todo.end_date,
                    };
                });
                renderCalendar(todos);
            },
            failure: function(errMsg) {
                console.log(errMsg)
            }
        });

        function renderCalendar(todos) {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid', 'list', 'bootstrap'],
                timeZone: 'UTC',
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                weekNumbers: true,
                eventLimit: true, // allow "more" link when too many events
                events: todos
            });

            calendar.render();
        }
    });
</script>