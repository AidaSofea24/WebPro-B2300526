<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - Admin</title>
    <link rel="stylesheet" href="Lib_admin.css">
</head>
<body>
    <header>
        <a href="mainpage.html">
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
            <div class="book-list-container" id="view-books">
                <h2>View All Books</h2>
                <div class="book-grid" id="bookGrid"></div>
            </div>
            <div class="book-form-container" id="add-book">
                <h2>Add a New Book</h2>
                <form action="add_book.php" method="post" enctype="multipart/form-data" class="book-form">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" required>
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" required>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" required>
                    <button type="submit">Add Book</button>
                </form>
            </div>
            <div class="manage-borrowing-container" id="manage-borrowing">
                <h2>Manage Borrowing</h2>
                <div class="book-grid" id="manageGrid"></div>
                <!-- Inside the book-grid div where books are displayed -->
                <div class="book-item">
                    <img src="data:image/jpeg;base64,${book.image}" alt="${book.title}">
                    <h3>${book.title}</h3>
                    <p>${book.genre}</p>
                    <button onclick="editBook(${book.book_id}, '${book.title}', '${book.genre}')">Edit</button>
                    <button onclick="deleteBook(${book.book_id})">Delete</button>
                </div>

            </div>
        </main>
    </section>
    <script src="admin_lib.js"></script>
</body>
</html>
