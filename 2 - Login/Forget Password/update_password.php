<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password - Logo Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Change Password</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bit102db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
        $email = $_GET["email"];
        $stmt = $conn->prepare("SELECT * FROM users_registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
            exit;
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["email"])) {
        $email = $_GET["email"];
        $newPassword = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        if ($newPassword !== $confirmPassword) {
            echo "<div class='alert alert-danger'>Passwords do not match.</div>";
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("UPDATE users_registration SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashedPassword, $email);

            if ($stmt->execute()) {
                echo "<script>
                alert('Password updated successfully');
                window.location.href = '../index.html';
                </script>";
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Email not found.</div>";
        exit;
    }

    $conn->close();
    ?>
    <form method="post" action="update_password.php?email=<?php echo htmlspecialchars($email); ?>" class="mt-4">
        <div class="form-group mb-3">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group mb-4">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>