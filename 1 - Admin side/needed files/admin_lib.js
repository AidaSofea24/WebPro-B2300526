// JavaScript to handle form submission, edit, and delete functionality

document.getElementById('addBookForm').addEventListener('submit', function(event) {
    // Example JavaScript for form validation or handling
    // Add your custom JavaScript code here if needed
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    fetch('add_book.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload(); // Reload the page to reflect the new book
    })
    .catch(error => console.error('Error:', error));
});

function editBook(bookId) {
    // Function to handle the edit book functionality
    document.getElementById('edit-book').style.display = 'block';
    document.getElementById('add-book').style.display = 'none';

    const bookItem = document.querySelector(`.book-item[data-id="${bookId}"]`);
    const title = bookItem.querySelector('h3:nth-child(2)').textContent;
    const genre = bookItem.querySelector('p').textContent;

    document.getElementById('editBookId').value = bookId;
    document.getElementById('editTitle').value = title;
    document.getElementById('editGenre').value = genre;
}

document.getElementById('editBookForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    fetch('edit_book.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload(); // Reload the page to reflect the updated book
    })
    .catch(error => console.error('Error:', error));
});

function deleteBook(bookId) {
    // Function to handle the delete book functionality
    if (confirm('Are you sure you want to delete this book?')) {
        fetch('delete_book.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `book_id=${bookId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Reload the page to reflect the deleted book
        })
        .catch(error => console.error('Error:', error));
    }
}
function filterAdminBooks() {
    const genreFilter = document.getElementById('adminGenreFilter').value;
    const bookItems = document.querySelectorAll('.book-item');
    bookItems.forEach(book => {
        const genre = book.getAttribute('data-genre');
        if (genreFilter === 'all' || genre === genreFilter) {
            book.style.display = 'block';
        } else {
            book.style.display = 'none';
        }
    });
}