document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');

    // Function to fetch and display books
    function fetchBooks() {
        fetch('fetch_books.php')
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data);
                if (data.success) {
                    displayBooks(data.books);
                } else {
                    console.error('Error fetching books:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Function to display books
    function displayBooks(books) {
        console.log('Books to display:', books);
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

    // Show borrow form
    window.setBorrowForm = function(bookId, title) {
        document.getElementById('book_id').value = bookId;
        document.getElementById('title').value = title;
        document.getElementById('borrowForm').style.display = 'block';
        document.getElementById('returnForm').style.display = 'none';
    };

    // Show return form
    window.setReturnForm = function(bookId, title) {
        document.getElementById('book_id_return').value = bookId;
        document.getElementById('title_return').value = title;
        document.getElementById('returnForm').style.display = 'block';
        document.getElementById('borrowForm').style.display = 'none';
    };

    // Borrow book
    window.borrowBook = function(event) {
        event.preventDefault();
        const formData = new FormData(document.getElementById('borrowForm'));
        fetch('borrow.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            document.getElementById('borrowResult').textContent = result;
            fetchBooks(); // Fetch and display updated books
        })
        .catch(error => console.error('Error:', error));
    };

    // Return book
    window.returnBook = function(event) {
        event.preventDefault();
        const formData = new FormData(document.getElementById('returnForm'));
        fetch('return.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            document.getElementById('returnResult').textContent = result;
            fetchBooks(); // Fetch and display updated books
        })
        .catch(error => console.error('Error:', error));
    };

    // Filter books
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

    // Search books
    window.searchBook = function() {
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
    };

    // Attach filter function to filter dropdowns
    document.getElementById('alphabetFilter').addEventListener('change', filterBooks);
    document.getElementById('genreFilter').addEventListener('change', filterBooks);

    // Initial fetch and display of books
    fetchBooks();
});
