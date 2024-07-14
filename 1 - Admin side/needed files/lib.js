const books = [
    { title: 'Expert Business Management', genre: 'Business', isBorrowed: false, image: 'book1.jpeg' },
    { title: 'A2 Physics cambridge level', genre: 'A-levels', isBorrowed: false, image: 'book2.jpeg' },
    { title: 'A2 Chemistry Coursebook cambridge level', genre: 'A-levels', isBorrowed: false, image: 'book3.jpeg' },
    { title: 'Little Book of Psychology', genre: 'Psychology', isBorrowed: false, image: 'book4.png' },
    { title: 'Computer Systems an introduction', genre: 'IT', isBorrowed: false, image: 'book5.jpeg' },
    { title: 'Discrete Mathematics with Applications', genre: 'IT', isBorrowed: false, image: 'book6.jpeg' },
    { title: 'Internstional Business Management', genre: 'Business', isBorrowed: false, image: 'book7.jpeg' },
    { title: 'The Science of Effective Communication', genre: 'media communicaations', isBorrowed: false, image: 'book8.jpeg' },
    { title: 'Neuroscience Canadian 1st edition book', genre: 'Psychology', isBorrowed: false, image: 'book9.jpeg' },
    { title: 'Fundamentals of Neuroscience', genre: 'Psychology', isBorrowed: false, image: 'book10.jpeg' },
    { title: 'To Kill a Mockingbird', genre: 'fiction', isBorrowed: false, image: 'image11.jpg' },
    { title: 'The Alchemist', genre: 'fiction', isBorrowed: false, image: 'image12.jpg' },
    { title: 'Pride and Prejudice', genre: 'fiction', isBorrowed: false, image: 'image13.jpg' },
    { title: 'Moby Dick', genre: 'fiction', isBorrowed: false, image: 'image14.jpg' },
    { title: 'Crime and Punishment', genre: 'Psychology', isBorrowed: false, image: 'image15.jpg' },
    { title: 'The Odyssey', genre: 'fiction', isBorrowed: false, image: 'image16.jpg' },
    { title: 'Les Misérables', genre: 'fiction', isBorrowed: false, image: 'image17.jpg' },
    { title: 'The Iliad', genre: 'fiction', isBorrowed: false, image: 'image18.jpg' },
    { title: 'Don Quixote', genre: 'fiction', isBorrowed: false, image: 'image19.jpg' },
    { title: 'The Brothers Karamazov', genre: 'fiction', isBorrowed: false, image: 'image20.jpg' }
];

function displayBooks(filteredBooks) {
    const bookGrid = document.getElementById('bookGrid');
    bookGrid.innerHTML = '';

    filteredBooks.forEach(book => {
        const div = document.createElement('div');
        div.classList.add('book-item');
        div.innerHTML = `
            <img src="${book.image}" alt="${book.title}">
            <h3>${book.title}</h3>
            <p>${book.genre.charAt(0).toUpperCase() + book.genre.slice(1)}</p>
            <button class="${book.isBorrowed ? 'return-btn' : 'borrow-btn'}" onclick="toggleBorrowBook('${book.title}')">
                ${book.isBorrowed ? 'Return' : 'Borrow'}
            </button>
        `;
        bookGrid.appendChild(div);
    });
}

function searchBook() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const filteredBooks = books.filter(book => book.title.toLowerCase().includes(searchInput));
    displayBooks(filteredBooks);
}

function filterBooks() {
    const alphabetFilter = document.getElementById('alphabetFilter').value;
    const genreFilter = document.getElementById('genreFilter').value;

    let filteredBooks = books;

    if (alphabetFilter !== 'all') {
        const range = alphabetFilter.split('-');
        filteredBooks = filteredBooks.filter(book => book.title.charAt(0).toUpperCase() >= range[0] && book.title.charAt(0).toUpperCase() <= range[1]);
    }

    if (genreFilter !== 'all') {
        filteredBooks = filteredBooks.filter(book => book.genre === genreFilter);
    }

    displayBooks(filteredBooks);
}

function toggleBorrowBook(title) {
    const book = books.find(book => book.title === title);
    book.isBorrowed = !book.isBorrowed;
    filterBooks();
}

// Initial display
displayBooks(books);
