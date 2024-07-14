<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BIT102";
 
if (isset($_POST["submit"])) {
    $title = htmlspecialchars($_POST["title"]);
    $itemDescription = htmlspecialchars($_POST["itemDescription"]);
    
    $targetDirectory = "uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
 
    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "<script>alert('File already exists.'); window.location.href = 'admin-lostAndFoundMainPage.php';</script>";
        $uploadOk = 0;
    }
 
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = 'admin-lostAndFoundMainPage.php';</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "<script>alert('The file of " . $title . " has been uploaded.'); window.location.href = 'admin-lostAndFoundMainPage.php';</script>";
 
            // Save file information to the database
            $conn = new mysqli($servername, $username, $password, $dbname);
 
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
 
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $filePath = $targetFile;
            
            $sql = "INSERT INTO uploads (file_name, file_path, title, itemDescription) VALUES ('$fileName', '$filePath', '$title', '$itemDescription')";
 
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('File information saved to database.'); window.location.href = 'admin-lostAndFoundMainPage.php';</script>";
            } else {
                echo '<script>alert("Error: ' . $conn->error . '");</script>';
            }
 
            $conn->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'admin-lostAndFoundMainPage.php';</script>";
        }
    }
}
?>
