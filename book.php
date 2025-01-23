<?php
session_start();
$title = "Index";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_category.php";
$conn = db_connect();
$query = getAll($conn);

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
</style>


<div class="container">
    <div class="row">
        <?php require_once "./template/sidebar_category.php"; ?>
        <div class="col-md-9">
            <!-- Main content code here -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="lead text-center text-muted">Latest books</p>
                    </div>
                </div>

                <?php
                $count = 0;
                $total_books = count($row);

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
                    if ($count % 4 == 0 || $count == $total_books) {
                        echo '</div>';
                    }
                }

                if ($total_books % 4 != 0 && $count % 4 != 0) {
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>