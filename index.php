<?php
session_start();
$count = 0;
// connecto database

$title = "Index";
require_once "./template/header.php";

require_once "./functions/database_functions.php";
require_once "./template/sidebar_category.php";
$conn = db_connect();
$row = select4LatestBook($conn);
$sales = getTop4Sales($conn);

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

<!-- Main content starts here -->
<div id="main-content">
  <p class="lead text-center text-muted">Latest books</p>
  <div class="row">
    <?php foreach ($row as $book) { ?>
      <div class="col-md-3">
        <a href="book_detail.php?bookisbn=<?php echo htmlspecialchars($book['book_isbn'], ENT_QUOTES, 'UTF-8'); ?>" class="book-link">
          <img class="img-responsive img-thumbnail"
            src="./bootstrap/img/<?php echo htmlspecialchars($book['book_image'], ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($book['book_title'] ?? 'Book Cover', ENT_QUOTES, 'UTF-8'); ?>">
          <span class="book-title"><?php echo htmlspecialchars($book['book_title'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-author"><?php echo htmlspecialchars($book['book_author'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-price"><?php echo number_format($book['book_price']); ?>$</span>
        </a>
      </div>
    <?php } ?>
  </div>
  <p class="lead text-center text-muted">Top sale</p>
  <div class="row">
    <?php foreach ($sales as $s) { ?>
      <div class="col-md-3">
        <a href="book_detail.php?bookisbn=<?php echo htmlspecialchars($s['book_isbn'], ENT_QUOTES, 'UTF-8'); ?>" class="book-link">
          <img class="img-responsive img-thumbnail"
            src="./bootstrap/img/<?php echo htmlspecialchars($s['book_image'], ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($s['book_title'] ?? 'Book Cover', ENT_QUOTES, 'UTF-8'); ?>">
          <span class="book-title"><?php echo htmlspecialchars($s['book_title'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-author"><?php echo htmlspecialchars($s['book_author'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-price"><?php echo number_format($s['book_price']); ?>$</span>
        </a>
      </div>
    <?php } ?>
  </div>
</div>

</div><!-- Close col-md-9 from sidebar -->
</div><!-- Close row from sidebar -->
</div><!-- Close container-fluid from sidebar -->
<?php
if (isset($conn)) {
  mysqli_close($conn);
}
require_once "./template/footer.php";
?>