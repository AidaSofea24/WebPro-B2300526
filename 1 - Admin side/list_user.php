<?php 
$page_title = "Login Form";
include('includes/session_check.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
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

        $sql = "SELECT * FROM users_registration";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Student ID</th>";
            echo "<th>Email</th>";
            echo "<th>Action</th>";
            echo "</tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["ID"]."</td>";
                echo "<td>".$row["first_name"]."</td>";
                echo "<td>".$row["last_name"]."</td>";
                echo "<td>".$row["student_id"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>
                        <a class='btn btn-sm btn-primary' href='user_management/edit_user.php?id=".$row["ID"]."'>Edit</a>
                        <a class='btn btn-sm btn-danger' href='user_management/delete_user.php?id=".$row["ID"]."' onclick='return confirmDelete()'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>0 results</div>";
        }

        // Close the connection
        $conn->close();
        ?>
        <script>function confirmDelete() { 
            return confirm("Are you sure you want to delete this user?");
            }</script>
            
    </div>

<?php include('includes/footer.php');?>