<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Room Booking System</title>
    <link rel="stylesheet" href="harrystyles.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
</head>
<body>
    <header>
        <a href="mainpage.html">
            <img src="BETTERHELP.jpeg" width="100"/>
        </a>
        <nav>
            <ul>
            </ul>
        </nav>
    </header>  
    <section>
        <h1>Library Room Booking Calendar</h1>
    
    <main>
        <div id="calendar"></div>
        <div id="booking-form">
            <h2>Book a Room</h2>
            <form id="room-booking-form" action="book_room.php" method="POST">
                <label for="campus">Campus:</label>
                <select id="campus" name="campus">
                    <option value="damansara">Damansara Campus</option>
                    <option value="subang">Subang 2 Campus</option>
                    <option value="elm">ELM Campus</option>
                </select>
                <label for="room">Room:</label>
                <select id="room" name="room">
                    <option value="room1">Room 1</option>
                    <option value="room2">Room 2</option>
                    <option value="room3">Room 3</option>
                </select>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="time">Time:</label>
                <select id="time" name="time" required>
                    <!-- Time slots will be populated dynamically by JavaScript -->
                </select>
                <label for="duration">Duration (hours):</label>
                <input type="number" id="duration" name="duration" min="1" max="8" required>
                <button type="submit">Book Room</button>
            </form>
        </div>
        <div id="time-slots">
            <h2>Available and Unavailable Time Slots</h2>
            <ul id="available-times">
                <!-- Available time slots will be displayed here -->
            </ul>
            <ul id="unavailable-times">
                <!-- Unavailable time slots will be displayed here -->
            </ul>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: 'fetch_bookings.php',
                dateClick: function(info) {
                    // Open booking form with the selected date
                    document.getElementById('date').value = info.dateStr;
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
