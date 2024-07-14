document.addEventListener("DOMContentLoaded", function() {
    fetchBooks();
});

function fetchBooks() {
    fetch('get_books.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayBooks(data.books, 'bookGrid');
                displayBooks(data.books, 'manageGrid', true);
            } else {
                alert('Error fetching books: ' + data.error);
            }
        });
}

function deleteBook(bookId) {
    fetch('delete_book.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ bookId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchBooks(); // Reload books after deleting
        } else {
            alert('Error deleting book: ' + data.error);
        }
    });
}

function editBook(bookId, title, genre) {
    const newTitle = prompt("Enter new title:", title);
    const newGenre = prompt("Enter new genre:", genre);

    if (newTitle !== null && newGenre !== null) {
        fetch('edit_book.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bookId,
                title: newTitle,
                genre: newGenre,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchBooks(); // Reload books after editing
            } else {
                alert('Error updating book details: ' + data.error);
            }
        });
    }
}

function displayBooks(books, gridId, manageBorrowing = false) {
    const bookGrid = document.getElementById(gridId);
    bookGrid.innerHTML = '';

    books.forEach(book => {
        const div = document.createElement('div');
        div.classList.add('book-item');
        div.innerHTML = `
            <img src="data:image/jpeg;base64,${book.image}" alt="${book.title}">
            <h3>${book.title}</h3>
            <p>${book.genre.charAt(0).toUpperCase() + book.genre.slice(1)}</p>
            ${manageBorrowing ? `
            <p>${book.isBorrowed ? 'Borrowed' : 'Available'}</p>
            <label for="studentId">Student ID:</label>
            <input type="text" id="studentId-${book.book_id}" name="studentId" value="${book.studentId || ''}">
            <label for="borrowDate">Borrow Date:</label>
            <input type="date" id="borrowDate-${book.book_id}" name="borrowDate" value="${book.borrowDate || ''}">
            <button onclick="toggleBorrowBook(${book.book_id})">${book.isBorrowed ? 'Return' : 'Borrow'}</button>
            <button onclick="calculatePenalty(${book.book_id})">Calculate Penalty</button>
            ` : `
            <button onclick="editBook(${book.book_id}, '${book.title}', '${book.genre}')">Edit</button>
            <button onclick="deleteBook(${book.book_id})">Delete</button>
            <p>${book.isBorrowed ? 'Borrowed' : 'Available'}</p>
            `}
        `;
        bookGrid.appendChild(div);
    });
}

function toggleBorrowBook(bookId) {
    const studentId = document.getElementById(`studentId-${bookId}`).value;
    const borrowDate = document.getElementById(`borrowDate-${bookId}`).value;
    fetch('toggle_borrow_book.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            bookId,
            studentId,
            borrowDate,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchBooks();
        } else {
            alert('Error updating book status: ' + data.error);
        }
    });
}

function calculatePenalty(bookId) {
    fetch(`calculate_penalty.php?bookId=${bookId}`)
        .then(response => response.json())
        .then(data => {
            alert(`Penalty for student: ${data.penalty}`);
        });
}
