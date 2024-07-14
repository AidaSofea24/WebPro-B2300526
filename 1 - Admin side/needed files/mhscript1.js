document.addEventListener('DOMContentLoaded', function () {
    const calendar = document.getElementById('calendar');
    const bookingForm = document.getElementById('appointment-booking-form');
    const timeSelect = document.getElementById('time');
    const availableTimesList = document.getElementById('available-times');
    const unavailableTimesList = document.getElementById('unavailable-times');
    let bookings = [];
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function fetchBookings() {
        return fetch('get_bookings.php')
            .then(response => response.json())
            .then(data => {
                bookings = data.bookings;
                createCalendar(currentMonth, currentYear);
            })
            .catch(error => {
                console.error('Error fetching bookings:', error);
            });
    }

    function createCalendar(month, year) {
        const currentDate = new Date(year, month);
        const monthName = currentDate.toLocaleString('default', { month: 'long' });
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDay = new Date(year, month, 1).getDay();

        calendar.innerHTML = '';
        const header = document.createElement('div');
        header.classList.add('calendar-header');
        header.innerHTML = `<button id="prev-month">◀</button> ${monthName} ${year} <button id="next-month">▶</button>`;
        calendar.appendChild(header);

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const daysHeader = document.createElement('div');
        daysHeader.classList.add('days-of-week');
        daysOfWeek.forEach(day => {
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            dayElement.innerText = day;
            daysHeader.appendChild(dayElement);
        });
        calendar.appendChild(daysHeader);

        const daysGrid = document.createElement('div');
        daysGrid.classList.add('days-grid');
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('day', 'empty');
            daysGrid.appendChild(emptyCell);
        }
        for (let i = 1; i <= daysInMonth; i++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day');
            dayCell.innerText = i;
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            dayCell.dataset.date = dateStr;
            if (isDateFullyBooked(dateStr)) {
                dayCell.classList.add('fully-booked');
            } else if (isDateBooked(dateStr)) {
                dayCell.classList.add('booked');
            }
            dayCell.addEventListener('click', () => {
                bookingForm.date.value = dateStr;
                populateTimeSlots(dateStr);
                showBookings(dateStr);
            });
            daysGrid.appendChild(dayCell);
        }
        calendar.appendChild(daysGrid);

        document.getElementById('prev-month').addEventListener('click', () => changeMonth(-1));
        document.getElementById('next-month').addEventListener('click', () => changeMonth(1));
    }

    function changeMonth(offset) {
        currentMonth += offset;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        createCalendar(currentMonth, currentYear);
    }

    function isDateBooked(date) {
        return bookings.some(booking => booking.date === date);
    }

    function isDateFullyBooked(date) {
        const bookingsForDate = bookings.filter(booking => booking.date === date);
        return bookingsForDate.length >= 13; // 9am to 9pm equals 13 hourly slots
    }

    function showBookings(date) {
        const bookingsForDate = bookings.filter(booking => booking.date === date);
        alert(`Bookings for ${date}:\n${bookingsForDate.length ? bookingsForDate.map(booking => `Gender: ${booking.gender}, Time: ${booking.time}, Duration: ${booking.duration}h`).join('\n') : 'No bookings'}`);
    }

    function populateTimeSlots(date) {
        availableTimesList.innerHTML = '';
        unavailableTimesList.innerHTML = '';
        timeSelect.innerHTML = '';
        const bookingsForDate = bookings.filter(booking => booking.date === date);
        const bookedTimes = bookingsForDate.map(booking => parseInt(booking.time.split(':')[0]));

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
    }

    bookingForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const student_id = bookingForm['student_id'].value;
        const gender = bookingForm.gender.value;
        const qualification = bookingForm.qualification.value;
        const date = bookingForm.date.value;
        const time = bookingForm.time.value;
        const status = bookingForm.status.value;

        console.log('Booking data:', { student_id, gender, qualification, date, time, status });

        if (status === 'no') {
            window.location.href = 'MHbooking.html';
            return;
        }

        // Sending data to PHP via fetch
        fetch('MH_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ student_id, gender, qualification, date, time, status }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response from server:', data);
            alert(data.message); // Display success or error message from PHP
            // You can handle UI updates or redirects based on server response
            if (data.message === "Booking successful") {
                // Update local bookings array if needed
                bookings.push({ student_id, gender, qualification, date, time, status });
                console.log('Updated bookings:', bookings);
                // Optionally, update calendar or UI here
                createCalendar(currentMonth, currentYear); // Example call to update calendar
            }
        })
        .catch(error => {
            console.error('Error sending data:', error);
            alert('Error booking appointment. Please try again.'); // Display error message
            // Handle errors during data transmission
        });

        // Reset form fields or update UI as needed
        bookingForm.reset();
        createCalendar(currentMonth, currentYear);
        populateTimeSlots(date);
    });

    fetchBookings();

    $(document).ready(function() {
        // Initialize carousel manually without automatic sliding
        $('#carouselExampleIndicators').carousel({
          interval: false // Disable automatic sliding
        });
      });

});
