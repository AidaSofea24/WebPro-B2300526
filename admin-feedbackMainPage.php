<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback and improvement for admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesElain.css">
</head>
<body>
    <div class="py-5 text-center" style="background-image: url('campus.png'); background-size: cover;">
      <div class="container">
        <div class="row">
          <div class="bg-white p-5 mx-auto col-md-8 col-10">
            <h3 class="display-3">Feedback and Improvement Center For Admin</h3>
            <p class="mb-3 lead">Enhancing Excellence Together!</p>
            <p class="mb-4">Welcome to the Admin Feedback and Improvement Center! This is where your insights and expertise drive progress. Revceive the valuable feedback, suggestions, and ideas from student to influence the future direction of our university.Let's create a better learning environment!</p> 
          </div>
        </div>
      </div>
    </div>
    <div class="container text-center" style="margin-top: 5%;">
        <div class="row justify-content-md-center">
          <div class="col col-lg-6" style="justify-content:center;">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="poll-tab" data-bs-toggle="tab" data-bs-target="#poll-tab-pane" type="button" role="tab" aria-controls="poll-tab-pane" aria-selected="true">&nbsp;&nbsp;&nbsp;&nbsp;New Suggest poll&nbsp;&nbsp;&nbsp;</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="result-tab" data-bs-toggle="tab" data-bs-target="#result-tab-pane" type="button" role="tab" aria-controls="result-tab-pane" aria-selected="false">&nbsp;&nbsp;&nbsp;Result Of The Vote&nbsp;&nbsp;</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="suggestion-tab" data-bs-toggle="tab" data-bs-target="#suggestion-tab-pane" type="button" role="tab" aria-controls="suggestion-tab-pane" aria-selected="false">&nbsp;Suggestion Received&nbsp;</button>
                </li>
            </ul>
          </div>

          <div class="col col-lg-12">
            <div class="tab-content" id="myTabContent">
                <!-- ✅Admin side - New Suggestions of poll -->
                <div class="tab-pane fade show active" id="poll-tab-pane" role="tabpanel" aria-labelledby="poll-tab" tabindex="0">
                    <div class="mt-5" style="justify-content: center; align-items: center;margin-left: 10%; margin-right: 10%;">
                        <div>
                            <h1>Suggestions of new poll</h1><br>
                            <hr class="mt-1" />
                        </div>
                
                        <table class="table table-sm table-hover align-middle">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col"></th>
                                    <th scope="col">Suggester's Name</th>
                                    <th scope="col">Poll Topic</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Option1</th>
                                    <th scope="col">Option2</th>
                                    <th scope="col">Option3</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "BIT102";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Handle deletion
                                if (isset($_POST['delete'])) {
                                    $idToDelete = $_POST['idToDelete'];
                                    $deleteSql = "DELETE FROM poll WHERE id = $idToDelete";
                                    if ($conn->query($deleteSql) === TRUE) {
                                        echo '<div class="alert alert-success" role="alert">Item deleted successfully.</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Error deleting item: ' . $conn->error . '</div>';
                                    }
                                }

                                // Fetch content from the database
                                $sql = "SELECT id, firstName, lastName, topic, description, option1, option2, option3, created_at FROM poll";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $firstName = $row["firstName"];
                                        $lastName = $row["lastName"];
                                        $topic = $row["topic"];
                                        $description = $row["description"];
                                        $option1 = $row["option1"];
                                        $option2 = $row["option2"];
                                        $option3 = $row["option3"];
                                        $created_at = $row["created_at"];

                                        echo "<tr>";
                                        echo "<th scope='row'>$counter</th>";
                                        echo "<td>$firstName</td>";
                                        echo "<td>$lastName</td>";
                                        echo "<td>$topic</td>";
                                        echo "<td>$description</td>";
                                        echo "<td>$option1</td>";
                                        echo "<td>$option2</td>";
                                        echo "<td>$option3</td>";
                                        echo "<td>$created_at</td>";

                                        echo "<td>
                                                <form method='post' action='{$_SERVER['PHP_SELF']}'>
                                                    <input type='hidden' name='idToDelete' value='$id'>
                                                    <button type='submit' name='delete' class='btn btn-outline-danger btn-sm'>Delete</button>
                                                </form>
                                            </td>";
                                        echo "</tr>";

                                        $counter++;
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No vote found.</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                    
                </div>
                <!-- end of admin side - New Suggestions of poll -->

                <!-- ✅Admin side - Result of vote -->
                <div class="tab-pane fade" id="result-tab-pane" role="tabpanel" aria-labelledby="result-tab" tabindex="0">
                    <div class="mt-5" style="justify-content: center; align-items: center;margin-left: 10%; margin-right: 10%;">
                        <div>
                            <h1>Vote Results</h1>
                            <hr class="mt-1" />
                        </div>
                        <table class="table table-sm table-hover align-middle">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col">Poll ID</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Option 1</th>
                                    <th scope="col">Option 2</th>
                                    <th scope="col">Option 3</th>
                                    <th scope="col">Option 1 Votes</th>
                                    <th scope="col">Option 2 Votes</th>
                                    <th scope="col">Option 3 Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "BIT102";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "
                                    SELECT 
                                        p.id AS poll_id,
                                        p.topic AS poll_topic,
                                        p.description AS poll_description,
                                        p.option1,
                                        p.option2,
                                        p.option3,
                                        COUNT(CASE WHEN v.voteOption = 'option1' THEN 1 END) AS option1_votes,
                                        COUNT(CASE WHEN v.voteOption = 'option2' THEN 1 END) AS option2_votes,
                                        COUNT(CASE WHEN v.voteOption = 'option3' THEN 1 END) AS option3_votes
                                    FROM 
                                        poll p
                                    LEFT JOIN 
                                        voteResult v ON p.id = v.pollID
                                    GROUP BY 
                                        p.id, p.topic, p.description, p.option1, p.option2, p.option3
                                    ORDER BY 
                                        p.id;
                                ";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["poll_id"] . "</td>";
                                        echo "<td>" . $row["poll_topic"] . "</td>";
                                        echo "<td>" . $row["poll_description"] . "</td>";
                                        echo "<td>" . $row["option1"] . "</td>";
                                        echo "<td>" . $row["option2"] . "</td>";
                                        echo "<td>" . $row["option3"] . "</td>";
                                        echo "<td>" . $row["option1_votes"] . "</td>";
                                        echo "<td>" . $row["option2_votes"] . "</td>";
                                        echo "<td>" . $row["option3_votes"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No results found</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--✅admin : suggestion received-->
                <div class="tab-pane fade" id="suggestion-tab-pane" role="tabpanel" aria-labelledby="suggestion-tab" tabindex="0">
                    <div class="mt-5" style="justify-content: center; align-items: center;margin-left: 10%; margin-right: 10%;">
                        <div>
                            <h1>Suggestions Box</h1>
                            <hr class="mt-1" />
                        </div>
                        <table class="table table-sm table-hover align-middle">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col"></th>
                                    <th scope="col">Suggester's Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "BIT102";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch content from the database
                                $sql = "SELECT id, name, email, message FROM suggestionBox";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $name = $row["name"];
                                        $email = $row["email"];
                                        $message = $row["message"];

                                        echo "<tr>";
                                        echo "<th scope='row'>$counter</th>";
                                        echo "<td>$name</td>";
                                        echo "<td>$email</td>";
                                        echo "<td>$message</td>";
                                        echo "</tr>";

                                        $counter++;
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No suggestion found.</td></tr>";
                                }

                                $conn->close();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end of admin-suggestion received-->
            </div>
          </div> 
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all the tab buttons
            var tabButtons = document.querySelectorAll(".nav-link");

            // Add click event listeners to each tab button
            tabButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Remove 'active' class from all tab buttons
                    tabButtons.forEach(function(btn) {
                        btn.classList.remove("active");
                    });

                    // Add 'active' class to the clicked tab button
                    button.classList.add("active");

                    // Get the target tab pane ID
                    var target = button.getAttribute("data-bs-target");

                    // Hide all tab panes
                    var tabPanes = document.querySelectorAll(".tab-pane");
                    tabPanes.forEach(function(pane) {
                        pane.classList.remove("show", "active");
                    });

                    // Show the corresponding tab pane
                    var targetPane = document.querySelector(target);
                    targetPane.classList.add("show", "active");
                });
            });
        });
    </script>
</body>
</html>