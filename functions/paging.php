<?php

function getPaginatedBooks($conn, $results_per_page = 12) {
    // Get the current page number from the query string, default to 1 if not set
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page); // Ensure page is at least 1

    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $results_per_page;

    // Get the total number of books
    $total_books_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
    $total_books = mysqli_fetch_assoc($total_books_query)['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_books / $results_per_page);

    // Get the books for the current page
    $query = mysqli_query($conn, "SELECT * FROM books LIMIT $results_per_page OFFSET $offset");

    // Convert the result set to an array
    $books = [];
    while ($book = mysqli_fetch_assoc($query)) {
        $books[] = $book;
    }

    return [
        'books' => $books,
        'total_pages' => $total_pages,
        'current_page' => $page
    ];
}
?>