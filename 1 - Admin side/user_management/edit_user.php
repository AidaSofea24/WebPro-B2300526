<?php 
$page_title = "Home page";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
        <h2>Edit User</h2>
        <?php
        $servername = "localhost"; // replace with your database host
        $username = "root"; // replace with your database username
        $password = ""; // replace with your database password
        $dbname = "bit102db"; // replace with your database name

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
            $id = $_GET["id"];
            $sql = "SELECT * FROM users_registration WHERE ID = $id";
            $result = $conn->query($sql);
     
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<div class='alert alert-danger'>User not found.</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>ID not found.</div>";
            exit;
        }
     
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_GET["id"];
            $newfirstname = $_POST["firstname"];
            $newlastname = $_POST["lastname"];
            $newEmail = $_POST["email"];
            $newPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
     
            $updateSql = "UPDATE users_registration SET 
            first_name = '$newfirstname', 
            last_name='$newlastname', 
            email = '$newEmail', 
            password = '$newPassword' WHERE id = $id";
     
            if ($conn->query($updateSql) === TRUE) {
                header("Location: list_user.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error: " . $updateSql . "<br>" . $conn->error . "</div>";
            }
        }
     
        $conn->close();
        ?>
     
        <form method="post" action="edit_user.php?id=<?php echo $id; ?>" class="mt-4">
            <div class="form-group">
                <label for="firstname">First name:</label>
                <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $row["first_name"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $row["last_name"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $row["email"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

<?php include('includes/footer.php');?>