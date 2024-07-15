<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library System</title>
    <link rel="stylesheet" href="lib.css">
</head>
<body>
    <div class="container">
        <h1>HELP Library Archive</h1>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search for a book title...">
            <button onclick="searchBook()">Search</button>
        </div>
        <div class="filter-container">
            <label for="alphabetFilter">Sort by Alphabet:</label>
            <select id="alphabetFilter" onchange="filterBooks()">
                <option value="all">All</option>
                <option value="A-F">A-F</option>
                <option value="G-L">G-L</option>
                <option value="M-R">M-R</option>
                <option value="S-Z">S-Z</option>
            </select>
            <label for="genreFilter">Sort by Genre:</label>
            <select id="genreFilter" onchange="filterBooks()">
                <option value="all">All</option>
                <option value="IT">IT</option>
                <option value="Business">Business</option>
                <option value="Psychology">Psychology</option>
                <option value="Media Communication">Media Communication</option>
            </select>
        </div>
        <div class="book-grid" id="bookGrid">
            <?php include 'lib.php'; ?>
        </div>
        <div class="borrow-form" style="display:none;">
            <form id="borrowForm" onsubmit="borrowBook(event)">
                <label for="book_id">Book ID:</label>
                <input type="text" id="book_id" name="book_id" readonly>
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" readonly>
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
                <button type="submit">Borrow</button>
                <p id="borrowResult"></p>
            </form>
        </div>
        <div class="return-form" style="display:none;">
            <form id="returnForm" onsubmit="returnBook(event)">
                <label for="book_id_return">Book ID:</label>
                <input type="text" id="book_id_return" name="book_id_return" readonly>
                <label for="title_return">Book Title:</label>
                <input type="text" id="title_return" name="title_return" readonly>
                <button type="submit">Return</button>
                <p id="returnResult"></p>
            </form>
        </div>
    </div>
    <script>
        function setBorrowForm(bookId, title) {
            document.getElementById('book_id').value = bookId;
            document.getElementById('title').value = title;
            document.querySelector('.borrow-form').style.display = 'block';
            document.querySelector('.return-form').style.display = 'none';
        }

        function setReturnForm(bookId, title) {
            document.getElementById('book_id_return').value = bookId;
            document.getElementById('title_return').value = title;
            document.querySelector('.return-form').style.display = 'block';
            document.querySelector('.borrow-form').style.display = 'none';
        }

        function borrowBook(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById('borrowForm'));
            fetch('borrow.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                document.getElementById('borrowResult').innerHTML = result;
                setTimeout(() => {
                    location.reload(); // Reload the page to fetch and display updated books
                }, 5000);
            })
            .catch(error => console.error('Error:', error));
        }

        function returnBook(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById('returnForm'));
            fetch('return.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                document.getElementById('returnResult').innerHTML = result;
                setTimeout(() => {
                    location.reload(); // Reload the page to fetch and display updated books
                }, 5000);
            })
            .catch(error => console.error('Error:', error));
        }

        function filterBooks() {
            const alphabetFilter = document.getElementById('alphabetFilter').value;
            const genreFilter = document.getElementById('genreFilter').value;
            fetch('fetch_books.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let filteredBooks = data.books;
                        if (alphabetFilter !== 'all') {
                            const range = alphabetFilter.split('-');
                            const start = range[0].charCodeAt(0);
                            const end = range[1].charCodeAt(0);
                            filteredBooks = filteredBooks.filter(book => {
                                const firstLetter = book.title.charCodeAt(0);
                                return firstLetter >= start && firstLetter <= end;
                            });
                        }
                        if (genreFilter !== 'all') {
                            filteredBooks = filteredBooks.filter(book => book.genre === genreFilter);
                        }
                        displayBooks(filteredBooks);
                    } else {
                        console.error('Error fetching books:', data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function searchBook() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            fetch('fetch_books.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const filteredBooks = data.books.filter(book => book.title.toLowerCase().includes(searchInput));
                        displayBooks(filteredBooks);
                    } else {
                        console.error('Error fetching books:', data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function displayBooks(books) {
            const bookGrid = document.getElementById('bookGrid');
            bookGrid.innerHTML = '';
            books.forEach(book => {
                const bookItem = document.createElement('div');
                bookItem.className = 'book-item';
                const bookImage = book.image ? `<img src="data:image/jpeg;base64,${book.image}" alt="${book.title}">` : '';
                const borrowButton = book.isBorrowed ? 
                    `<button onclick="setReturnForm(${book.book_id}, '${book.title}')">Return</button>` :
                    `<button onclick="setBorrowForm(${book.book_id}, '${book.title}')">Borrow</button>`;
                bookItem.innerHTML = `
                    ${bookImage}
                    <p>${book.title} (${book.genre})</p>
                    ${borrowButton}
                `;
                bookGrid.appendChild(bookItem);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            filterBooks(); // Initial load of books
        });
    </script>
</body>
</html>
