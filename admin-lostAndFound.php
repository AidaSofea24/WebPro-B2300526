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
    <div class="container text-center" style="margin-top: 5%;">
        <div class="row justify-content-md-center">
          <div class="col col-lg-3">
            <ul class="nav flex-column nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane" aria-selected="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lost item details&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="addNew-tab" data-bs-toggle="tab" data-bs-target="#addNew-tab-pane" type="button" role="tab" aria-controls="addNew-tab-pane" aria-selected="false">&nbsp;&nbsp;Add a new lost item&nbsp;&nbsp;</button>
                </li>
            </ul>
          </div>
          <div class="col col-lg-9">
            <div class="tab-content" id="myTabContent">
                <!-- Admin side - Lost Item Details -->
                <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel" aria-labelledby="detail-tab" tabindex="0">
                    <div>
                        <h2>Lost Item Details</h2>
                        <hr class="mt-1" />
                    </div>
                    <table class="table table-sm table-hover align-middle">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
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
                                $deleteSql = "DELETE FROM uploads WHERE id = $idToDelete";
                                if ($conn->query($deleteSql) === TRUE) {
                                    echo '<div class="alert alert-success" role="alert">Item deleted successfully.</div>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Error deleting item: ' . $conn->error . '</div>';
                                }
                            }

                            // Fetch content from the database
                            $sql = "SELECT id, file_name, file_path, upload_time, title, itemDescription FROM uploads";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row["id"];
                                    $fileName = $row["file_name"];
                                    $title = $row["title"];
                                    $itemDescription = $row["itemDescription"];
                                    $filePath = $row["file_path"];

                                    echo "<tr>";
                                    echo "<th scope='row'>$counter</th>";
                                    echo "<td>$title</td>";
                                    echo "<td>$itemDescription</td>";
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
                                echo "<tr><td colspan='4'>No files found.</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Admin side - Add new lost item -->
                <div class="tab-pane fade" id="addNew-tab-pane" role="tabpanel" aria-labelledby="addNew-tab" tabindex="0">
                    <div class="mt-5" style="justify-content: center; align-items: center;margin-left: 20%; margin-right: 20%;">
                        <form class="row g-3" action="admin-uploadLostItem.php" method="post" enctype="multipart/form-data"> <!-- Keyword to upload file: enctype="multipart/form-data" -->
                            <h1>Add a new lost item</h1>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Title</label>
                                <input type="text" aria-label="title" class="form-control" name="title" id="title">
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"> 
                                    <label class="input-group-text" for="lostItemPic" name="lostItemPic" id="lostItemPic">Upload</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="itemDescription" id="itemDescription" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Description</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-dark" name="submit" value="Upload File">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
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