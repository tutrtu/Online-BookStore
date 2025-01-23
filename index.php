<?php
session_start();
$count = 0;
// connecto database

$title = "Index";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();
$row = select4LatestBook($conn);
$sales = getTop4Sales($conn);
//require_once "./template/sidebar.php";
?>

<style>
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
        <a href="book_detail.php?bookisbn=<?php echo $book['book_isbn']; ?>">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          
        </a>

        <span class="book-title"><?php echo htmlspecialchars($book['book_title'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-author"><?php echo htmlspecialchars($book['book_author'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-price"><?php echo number_format($book['book_price']); ?>$</span>
      </div>
    <?php } ?>
    
  </div>


  <p class="lead text-center text-muted">Top Sales books</p>
  <div class="row">
    <?php foreach ($sales as $book) { ?>
      <div class="col-md-3">
        <a href="book_detail.php?bookisbn=<?php echo $book['book_isbn']; ?>">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          
        </a>

        <span class="book-title"><?php echo htmlspecialchars($book['book_title'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-author"><?php echo htmlspecialchars($book['book_author'], ENT_QUOTES, 'UTF-8'); ?></span>
          <span class="book-price"><?php echo number_format($book['book_price']); ?>$</span>
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