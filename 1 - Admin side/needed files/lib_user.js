document.addEventListener('DOMContentLoaded', (event) => {
    fetchBooks();
});

function fetchBooks() {
    fetch('fetch_books.php')
    .then(response => response.json())
    .then(data => {
        displayBooks(data);
    })
    .catch(error => console.error('Error:', error));
}

function displayBooks(books) {
    const bookGrid = document.getElementById('bookGrid');
    bookGrid.innerHTML = '';
    books.forEach(book => {
        const bookItem = document.createElement('div');
        bookItem.className = 'book-item';
        bookItem.innerHTML = `
            <h3>${book.title}</h3>
            <p>${book.genre}</p>
        `;
        bookGrid.appendChild(bookItem);
    });
}

function searchBook() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const bookItems = document.querySelectorAll('.book-item');
    bookItems.forEach(book => {
        const title = book.querySelector('h3').textContent.toLowerCase();
        if (title.includes(searchInput)) {
            book.style.display = 'block';
        } else {
            book.style.display = 'none';
        }
    });
}

function filterBooks() {
    const alphabetFilter = document.getElementById('alphabetFilter').value;
    const genreFilter = document.getElementById('genreFilter').value;
    const bookItems = document.querySelectorAll('.book-item');
    bookItems.forEach(book => {
        const title = book.querySelector('h3').textContent;
        const genre = book.querySelector('p').textContent;
        let display = true;

        if (alphabetFilter !== 'all') {
            const firstLetter = title.charAt(0).toUpperCase();
            const inRange = (alphabetFilter === 'A-F' && firstLetter >= 'A' && firstLetter <= 'F') ||
                            (alphabetFilter === 'G-L' && firstLetter >= 'G' && firstLetter <= 'L') ||
                            (alphabetFilter === 'M-R' && firstLetter >= 'M' && firstLetter <= 'R') ||
                            (alphabetFilter === 'S-Z' && firstLetter >= 'S' && firstLetter <= 'Z');
            if (!inRange) display = false;
        }

        if (genreFilter !== 'all' && genre !== genreFilter) {
            display = false;
        }

        book.style.display = display ? 'block' : 'none';
    });
}
