document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function(info) {
            const dateStr = info.dateStr;
            document.getElementById('date').value = dateStr;
            populateTimeSlots(dateStr);
        },
        events: fetchBookings
    });

    calendar.render();

    function fetchBookings() {
        fetch('get_bookings.php')
            .then(response => response.json())
            .then(data => {
                calendar.removeAllEvents();
                data.bookings.forEach(booking => {
                    calendar.addEvent({
                        title: `Booking: ${booking.gender} (${booking.time})`,
                        start: booking.date,
                        allDay: true
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching bookings:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Handle delete action
        document.querySelectorAll('.delete-booking').forEach(button => {
            button.addEventListener('click', function () {
                const bookingId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this booking?')) {
                    // Send request to server to delete booking
                    fetch(`delete_booking.php?id=${bookingId}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Booking deleted successfully');
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            alert('Failed to delete booking');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the booking');
                    });
                }
            });
        });
    
        // Handle edit action
        document.querySelectorAll('.edit-booking').forEach(button => {
            button.addEventListener('click', function () {
                const bookingId = this.getAttribute('data-id');
                // Fetch booking data and populate the form for editing
                fetch(`get_booking.php?id=${bookingId}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate the form fields with booking data
                        document.getElementById('date').value = data.booking.date;
                        document.getElementById('time').value = data.booking.time;
                        document.getElementById('gender').value = data.booking.gender;
                        // Add a hidden field to track the booking ID being edited
                        let bookingIdField = document.createElement('input');
                        bookingIdField.type = 'hidden';
                        bookingIdField.id = 'booking-id';
                        bookingIdField.name = 'booking_id';
                        bookingIdField.value = data.booking.booking_id;
                        document.getElementById('appointment-booking-form').appendChild(bookingIdField);
                    } else {
                        alert('Failed to fetch booking data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching the booking data');
                });
            });
        });
    });
    

    function populateTimeSlots(date) {
        const availableTimesList = document.getElementById('available-times');
        const unavailableTimesList = document.getElementById('unavailable-times');
        const timeSelect = document.getElementById('time');
        
        availableTimesList.innerHTML = '';
        unavailableTimesList.innerHTML = '';
        timeSelect.innerHTML = '';

        fetch('get_bookings.php')
            .then(response => response.json())
            .then(data => {
                const bookings = data.bookings.filter(booking => booking.date === date);
                const bookedTimes = bookings.map(booking => parseInt(booking.time.split(':')[0]));

                for (let hour = 9; hour <= 21; hour++) {
                    const timeSlot = document.createElement('li');
                    timeSlot.innerText = `${String(hour).padStart(2, '0')}:00 - ${String(hour + 1).padStart(2, '0')}:00`;

                    const option = document.createElement('option');
                    option.value = `${String(hour).padStart(2, '0')}:00`;
                    option.innerText = `${String(hour).padStart(2, '0')}:00`;

                    if (bookedTimes.includes(hour)) {
                        unavailableTimesList.appendChild(timeSlot);
                        timeSlot.style.color = 'red';
                    } else {
                        availableTimesList.appendChild(timeSlot);
                        timeSelect.appendChild(option);
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching bookings:', error);
            });
    }

    document.getElementById('appointment-booking-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const student_id = this['student_id'].value;
        const gender = this.gender.value;
        const room = this.room.value;
        const date = this.date.value;
        const time = this.time.value;

        fetch('MH_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ student_id, gender, room, date, time }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.message === "Booking successful") {
                fetchBookings();
            }
        })
        .catch(error => {
            console.error('Error sending data:', error);
            alert('Error booking appointment. Please try again.');
        });

        this.reset();
    });

    fetchBookings();
});
