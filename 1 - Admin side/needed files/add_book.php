<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Retrieve form data
$title = $_POST['title'];
$genre = $_POST['genre'];

// Check if file is uploaded and no error occurred
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Get temporary file name
    $imageTmpName = $_FILES['image']['tmp_name'];
    // Read image data into a variable
    $imageData = file_get_contents($imageTmpName);
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO books (title, genre, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $genre, $imageData);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'New book added successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'File upload error.']);
}

// Close database connection
$conn->close();
?>
