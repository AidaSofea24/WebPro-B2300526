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

    <!-- Edit Modal -->
    <div id="editModal" style="display:none;">
        <div>
            <h2>Edit Booking</h2>
            <form id="edit-form">
                <input type="hidden" name="booking_id" id="edit-booking-id">
                <label for="edit-student-id">Student ID:</label>
                <input type="text" name="student_id" id="edit-student-id" required>
                <label for="edit-date">Date:</label>
                <input type="date" name="date" id="edit-date" required>
                <label for="edit-time">Time:</label>
                <input type="time" name="time" id="edit-time" required>
                <label for="edit-gender">Therapist Gender:</label>
                <select name="gender" id="edit-gender">
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                    <option value="no_preference">No Preference</option>
                </select>
                <label for="edit-room">Counseling Room:</label>
                <input type="text" name="room" id="edit-room" required>
                <label for="edit-therapist">Therapist:</label>
                <input type="text" name="therapist" id="edit-therapist" required>
                <button type="submit">Update Booking</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.9.0/main.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.9.0/main.global.min.js"></script>
    <script src="Mhadmin.js"></script>

    <!-- Custom Script -->
    <script>
        // Delete booking script
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (confirm('Are you sure you want to delete this booking?')) {
                    let formData = new FormData(this);
                    fetch('delete_booking.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.includes('Booking deleted successfully')) {
                            alert('Booking deleted successfully');
                            window.location.reload();
                        } else {
                            alert('Error deleting booking: ' + data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });

        // Edit booking script
        document.querySelectorAll('.edit-booking').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('edit-booking-id').value = this.dataset.id;
                document.getElementById('edit-student-id').value = this.dataset.student;
                document.getElementById('edit-date').value = this.dataset.date;
                document.getElementById('edit-time').value = this.dataset.time;
                document.getElementById('edit-gender').value = this.dataset.gender;
                document.getElementById('edit-room').value = this.dataset.room;
                document.getElementById('edit-therapist').value = this.dataset.therapist;
                document.getElementById('editModal').style.display = 'block';
            });
        });

        document.getElementById('edit-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            fetch('edit_booking.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Booking updated successfully')) {
                    alert('Booking updated successfully');
                    window.location.reload();
                } else {
                    alert('Error updating booking: ' + data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
