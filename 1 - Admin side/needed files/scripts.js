document.addEventListener('DOMContentLoaded', function () {
    const calendar = document.getElementById('calendar');
    const bookingForm = document.getElementById('room-booking-form');
    const timeSelect = document.getElementById('time');
    const availableTimesList = document.getElementById('available-times');
    const unavailableTimesList = document.getElementById('unavailable-times');
    const bookings = [
        { campus: 'damansara', room: 'room1', date: '2024-06-10', time: '09:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-10', time: '10:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-10', time: '11:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-11', time: '09:00', duration: 1 },
        { campus: 'subang', room: 'room2', date: '2024-06-12', time: '14:00', duration: 1 },
        { campus: 'elm', room: 'room3', date: '2024-06-13', time: '16:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '09:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '10:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '11:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '12:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '13:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '14:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '15:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '16:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '17:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '18:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '19:00', duration: 1 },
        { campus: 'damansara', room: 'room1', date: '2024-06-14', time: '20:00', duration: 1 }
    ];
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

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
            dayCell.addEventListener('click', () => showBookings(dateStr));
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
        const bookingsForDate= bookings.filter(booking => booking.date === date);
        populateTimeSlots(date);
        alert(`Bookings for ${date}:\n${bookingsForDate.length ? bookingsForDate.map(booking => `Campus: ${booking.campus}, Room: ${booking.room}, Time: ${booking.time}, Duration: ${booking.duration}h`).join('\n') : 'No bookings'}`);
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

        const campus = bookingForm.campus.value;
        const room = bookingForm.room.value;
        const date = bookingForm.date.value;
        const time = bookingForm.time.value;
        const duration = bookingForm.duration.value;

        bookings.push({ campus, room, date, time, duration });
        createCalendar(currentMonth, currentYear);
        alert('Booking successful!');
        bookingForm.reset();
        populateTimeSlots(date);
    });

    createCalendar(currentMonth, currentYear);
});
