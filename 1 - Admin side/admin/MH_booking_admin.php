<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Appointment Booking System - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css">
    <link rel="stylesheet" href="Mhadmin.css">
</head>
<body>
    <header>
        <a href="mainpage.html">
            <img src="BETTERHELP.jpeg" width="100" alt="BetterHelp Logo"/>
        </a>
        <nav>
            <ul>
                <li><a href="#view-bookings">View Bookings</a></li>
                <li><a href="#add-booking">Add Booking</a></li>
                <li><a href="#view-surveys">View Student Survey</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h1>Admin Dashboard - Mental Health Appointment Booking System</h1>
    
        <main>
            <div class="calendar-container">
                <div id="calendar"></div>
                <input type="date" id="calendar-date" name="date" required>
                <button id="reset-date">Reset to Current Date</button>
            </div>
            <div class="booking-form-container" id="add-booking">
                <div id="booking-form">
                    <h2>Add a New Booking</h2>
                    <form id="appointment-booking-form">
                        <label for="gender">Therapist:</label>
                        <select id="gender" name="gender">
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="no_preference">No Preference</option>
                        </select>
                        <label for="room">Counseling Room:</label>
                        <select id="room" name="room">
                            <option value="1">Room 1</option>
                            <option value="2">Room 2</option>
                            <option value="3">Room 3</option>
                            <option value="4">Room 4</option>
                        </select>
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                        <label for="time">Time:</label>
                        <select id="time" name="time" required>
                            <!-- Time slots will be populated dynamically by JavaScript -->
                        </select>
                        <button type="submit">Add Booking</button>
                    </form>
                </div>
            </div>
            <div class="time-slots-container">
                <h2>Available and Unavailable Time Slots</h2>
                <ul id="available-times">
                    <!-- Available time slots will be displayed here -->
                </ul>
                <ul id="unavailable-times">
                    <!-- Unavailable time slots will be displayed here -->
                </ul>
            </div>
            <div class="view-bookings-container" id="view-bookings">
                <h2>View All Bookings</h2>
                <?php include 'view_bookings.php'; ?>
            </div>
            <div class="view-surveys-container" id="view-surveys">
                <h2>View Survey Responses</h2>
                <?php include 'view_survey.php'; ?>
            </div>
        </main>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.9.0/main.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.9.0/main.global.min.js"></script>
    <script src="Mhadmin.js"></script>
</body>
</html>
