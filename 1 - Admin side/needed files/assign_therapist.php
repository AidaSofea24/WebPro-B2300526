<?php
include 'db_connection.php';

function assignTherapist($booking) {
    global $conn;

    // Fetch student preferences
    $student_query = "SELECT gender_preference, qualification_preference FROM students WHERE id = ?";
    $stmt = $conn->prepare($student_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $student_result = $stmt->get_result();
    $student = $student_result->fetch_assoc();
    $stmt->close();

    // Fetch available therapists matching the preferences
    $therapist_query = "SELECT id FROM therapists WHERE gender = ? AND qualification = ?";
    $stmt = $conn->prepare($therapist_query);
    $stmt->bind_param("ss", $student['gender_preference'], $student['qualification_preference']);
    $stmt->execute();
    $therapist_result = $stmt->get_result();
    
    if ($therapist_result->num_rows > 0) {
        $therapist = $therapist_result->fetch_assoc();
        $therapist_id = $therapist['id'];

        // Assign therapist to the student
        $appointment_query = "INSERT INTO appointments (student_id, therapist_id, appointment_date) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($appointment_query);
        $stmt->bind_param("ii", $student_id, $therapist_id);
        $stmt->execute();
        $stmt->close();

        echo "Therapist assigned successfully.";
    } else {
        echo "No suitable therapist found based on the preferences.";
    }
}

// Example usage
if (isset($_GET['student_id'])) {
    $student_id = intval($_GET['student_id']);
    assignTherapist($student_id);
}
?>
