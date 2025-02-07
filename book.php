<?php
session_start(); 
$title = "Index"; 
require_once "./template/header.php"; 
require_once "./functions/database_functions.php"; 

$conn = db_connect(); 

// Pagination setup
$results_per_page = 12; // 4 columns * 3 rows
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure page is at least 1

// Calculate offset
$offset = ($page - 1) * $results_per_page;

// Get total number of books
$total_books_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
$total_books = mysqli_fetch_assoc($total_books_query)['total'];

// Calculate total pages
$total_pages = ceil($total_books / $results_per_page);

// Modify the getAll function in database_functions.php to support pagination
$query = mysqli_query($conn, "SELECT * FROM books LIMIT $results_per_page OFFSET $offset");

// Convert mysqli_result to array
$row = [];
while ($book = mysqli_fetch_assoc($query)) {
    $row[] = $book;
}
?>

<style>
    .book-container {
        margin-bottom: 30px;
        text-align: center;
    }

    .book-container img {
        width: 100%;
        max-height: 350px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .row {
        margin-bottom: 20px;
    }

    .book-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .book-link:hover {
        text-decoration: none;
        color: inherit;
    }

    .book-title {
        font-weight: bold;
        font-size: 1.4em;
        margin: 8px 0 5px 0;
        display: block;
    }

    .book-author {
        color: #333;
        font-size: 1.1em;
        margin-bottom: 5px;
        display: block;
    }

    .book-price {
        color: #FF0000;
        font-size: 1.2em;
        display: block;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a, .pagination span {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .pagination .active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }
    .pagination {
        display: flex;
        justify-content: center;
    margin-top: 20px;
    margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="lead text-center text-muted">Latest books</p>
                    </div>
                </div>

                <?php
                $count = 0;
                $total_books_on_page = count($row);

                foreach ($row as $book) {
                    if ($count % 4 == 0) {
                        echo '<div class="row">';
                    }
                ?>
                    <div class="col-md-3 book-container">
                        <a href="book_detail.php?bookisbn=<?php echo htmlspecialchars($book['book_isbn'], ENT_QUOTES, 'UTF-8'); ?>" class="book-link">
                            <img class="img-responsive img-thumbnail"
                                src="./bootstrap/img/<?php echo htmlspecialchars($book['book_image'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($book['book_title'] ?? 'Book Cover', ENT_QUOTES, 'UTF-8'); ?>">
                            <span class="book-title"><?php echo htmlspecialchars($book['book_title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="book-author"><?php echo htmlspecialchars($book['book_author'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="book-price"><?php echo number_format($book['book_price']); ?>$</span>
                        </a>
                    </div>
                <?php
                    $count++;
                    if ($count % 4 == 0 || $count == $total_books_on_page) {
                        echo '</div>';
                    }
                }

                if ($total_books_on_page % 4 != 0 && $count % 4 != 0) {
                    echo '</div>';
                }
                ?>
            </div>

            <!-- Pagination -->
            
        </div>
    </div>
    <div class="pagination">
                <?php
                // Previous page link
                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "'>«</a>";
                }

                // Page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<span class='active'>$i</span>";
                    } else {
                        echo "<a href='?page=$i'>$i</a>";
                    }
                }

                // Next page link
                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "'>»</a>";
                }
                ?>
            </div>
</div>

<?php
 
if (isset($conn)) {
    mysqli_close($conn); 
} 
require_once "./template/footer.php"; 
?>