document.addEventListener('DOMContentLoaded', function () {
    initCalendar();
    initBookingForm();
    fetchBookings();
});

let bookings = []; // Global variable to store bookings data

function initCalendar() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [], // Events will be dynamically fetched and populated
        eventClick: function (info) {
            viewBooking(info.event.id); // Handle event click to view details
        }
    });
    calendar.render();
}

function initBookingForm() {
    const bookingForm = document.getElementById('appointment-booking-form');

    // Function to populate time slots based on selected date
    function populateTimeSlots(date) {
        const timeSelect = document.getElementById('time');
        timeSelect.innerHTML = '';

        // Dummy data for time slots, replace with actual implementation
        const timeSlots = [
            { value: '09:00', label: '09:00 AM' },
            { value: '10:00', label: '10:00 AM' },
            { value: '11:00', label: '11:00 AM' },
            // Add more time slots as needed
        ];

        timeSlots.forEach(slot => {
            const option = document.createElement('option');
            option.value = slot.value;
            option.textContent = slot.label;
            timeSelect.appendChild(option);
        });
    }

    bookingForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const gender = bookingForm.gender.value;
        const room = bookingForm.room.value;
        const date = bookingForm.date.value;
        const time = bookingForm.time.value;

        // Dummy data for booking, replace with actual implementation
        const newBooking = {
            id: bookings.length + 1,
            date: date,
            time: time,
            duration: '1 hour',
            therapistGender: gender,
            room: room
        };

        // Add new booking to local data
        bookings.push(newBooking);
        renderBookings(); // Update bookings table

        // Reset form fields
        bookingForm.reset();
    });

    // Initialize date field to today's date
    const currentDate = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = currentDate;

    // Initial population of time slots for today's date
    populateTimeSlots(currentDate);
}

function fetchBookings() {
    // Dummy data for bookings, replace with actual implementation
    bookings = [
        {
            id: 1,
            date: '2024-07-15',
            time: '09:00',
            duration: '1 hour',
            therapistGender: 'female',
            room: 'Room 1'
        },
        {
            id: 2,
            date: '2024-07-16',
            time: '10:00',
            duration: '1 hour',
            therapistGender: 'male',
            room: 'Room 2'
        },
        // Add more bookings as needed
    ];

    renderBookings();
}

function renderBookings() {
    const bookingsTable = document.getElementById('bookings-table').getElementsByTagName('tbody')[0];
    bookingsTable.innerHTML = '';

    bookings.forEach(booking => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${booking.date}</td>
            <td>${booking.time}</td>
            <td>${booking.duration}</td>
            <td>${booking.therapistGender}</td>
            <td>${booking.room}</td>
            <td>
                <button onclick="viewBooking(${booking.id})">View</button>
                <button onclick="editBooking(${booking.id})">Edit</button>
                <button onclick="deleteBooking(${booking.id})">Delete</button>
            </td>
        `;
        bookingsTable.appendChild(row);
    });
}

function viewBooking(id) {
    const booking = bookings.find(b => b.id === id);
    if (booking) {
        alert(`Booking Details:\nDate: ${booking.date}\nTime: ${booking.time}\nDuration: ${booking.duration}\nTherapist Gender: ${booking.therapistGender}\nRoom: ${booking.room}`);
    } else {
        alert('Booking not found.');
    }
}

function editBooking(id) {
    const booking = bookings.find(b => b.id === id);
    if (booking) {
        // Populate form fields with booking data for editing
        document.getElementById('gender').value = booking.therapistGender;
        document.getElementById('room').value = booking.room;
        document.getElementById('date').value = booking.date;
        document.getElementById('time').value = booking.time;

        // Implement your edit logic here
        // For simplicity, you can just alert a message for demo purposes
        alert(`Editing booking with ID ${id}`);
    } else {
        alert('Booking not found.');
    }
}

function deleteBooking(id) {
    const confirmed = confirm('Are you sure you want to delete this booking?');
    if (confirmed) {
        // Dummy logic to delete from local data, replace with actual implementation
        bookings = bookings.filter(b => b.id !== id);
        renderBookings(); // Update bookings table

        // Alert for demo purposes
        alert(`Booking with ID ${id} deleted.`);
    }
}
