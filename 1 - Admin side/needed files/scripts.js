document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'fetch_lib_bookings.php',
        dateClick: function(info) {
            document.getElementById('date').value = info.dateStr;
            updateAvailableTimes(info.dateStr);
        }
    });

    calendar.render();
});

function updateAvailableTimes(date) {
    fetch('fetch_avail.php?date=' + date)
        .then(response => response.json())
        .then(data => {
            const timeSelect = document.getElementById('time');
            timeSelect.innerHTML = '';
            data.availableTimes.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                timeSelect.appendChild(option);
            });

            document.getElementById('available-times').innerHTML = data.availableTimes.map(time => `<li>${time}</li>`).join('');
            document.getElementById('unavailable-times').innerHTML = data.unavailableTimes.map(time => `<li>${time}</li>`).join('');
        })
        .catch(error => console.error('Error:', error));
}
