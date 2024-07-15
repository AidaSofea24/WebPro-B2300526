<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Library System</title>
    <link rel="stylesheet" href="Lib_admin.css">
</head>
<body>
    <header>
        <a href="dashboard.php">
            <img src="BETTERHELP.jpeg" width="100" alt="Library Logo"/>
        </a>
        <nav>
            <ul>
                <li><a href="#view-books">View Books</a></li>
                <li><a href="#add-book">Add Book</a></li>
                <li><a href="#manage-borrowing">Manage Borrowing</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h1>Admin Dashboard - Library System</h1>
        <main>
            <div class="filter-container">
                <label for="adminGenreFilter">Sort by Genre:</label>
                <select id="adminGenreFilter" onchange="filterAdminBooks()">
                    <option value="all">All</option>
                    <option value="IT">IT</option>
                    <option value="Business">Business</option>
                    <option value="Psychology">Psychology</option>
                    <option value="Media Communication">Media Communication</option>
                </select>
            </div>
            <div class="book-list-container" id="view-books">
                <h2>View All Books</h2>
                <div class="book-grid" id="adminBookGrid">
                    <?php
                    // PHP code to fetch and display books
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "assignment2024";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM books";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="book-item" data-id="' . $row['book_id'] . '" data-genre="' . $row['genre'] . '">';
                            echo '<h3>' . $row['book_id'] . '</h3>';
                            echo '<h3>' . $row['title'] . '</h3>';
                            echo '<p>' . $row['genre'] . '</p>';
                            echo '<button onclick="editBook(' . $row['book_id'] . ')">Edit</button>';
                            echo '<button onclick="deleteBook(' . $row['book_id'] . ')">Delete</button>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No books found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
            <div class="book-form-container" id="add-book">
                <h2>Add a New Book</h2>
                <form id="addBookForm" enctype="multipart/form-data" action="add_book.php" method="POST">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" required>
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <button type="submit">Add Book</button>
                </form>
            </div>
            <div class="book-form-container" id="edit-book" style="display: none;">
                <h2>Edit Book</h2>
                <form id="editBookForm" enctype="multipart/form-data" action="edit_book.php" method="POST">
                    <input type="hidden" id="editBookId" name="book_id">
                    <label for="editTitle">Book Title:</label>
                    <input type="text" id="editTitle" name="title" required>
                    <label for="editGenre">Genre:</label>
                    <input type="text" id="editGenre" name="genre" required>
                    <label for="editImage">Image:</label>
                    <input type="file" id="editImage" name="image" accept="image/*">
                    <button type="submit">Update Book</button>
                </form>
            </div>
            <div class="manage-borrowing-container" id="manage-borrowing">
                <h2>Manage Borrowing</h2>
                <div class="book-grid" id="manageGrid"></div>
            </div>
        </main>
    </section>
    <script src="admin_lib.js"></script>
</body>
</html>
