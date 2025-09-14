// Confirmation before deleting a book
const deleteLinks = document.querySelectorAll('.book-card a');

deleteLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        const confirmDelete = confirm('Are you sure you want to delete this book?');
        if (!confirmDelete) {
            e.preventDefault();
        }
    });
});
