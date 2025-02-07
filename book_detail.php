<?php
session_start();
$book_isbn = $_GET['bookisbn'];
$count = 0;

$title = "Book Detail";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();
$result = getBookByIsbn($conn, $book_isbn);
?>

<div class="container book-detail-page">
  <?php
  if (mysqli_num_rows($result) == 0) {
    echo "<p class='text-danger text-center'>We are sorry, but the book is not available.</p>";
  } else {
    $row = mysqli_fetch_assoc($result);
  ?>
    <div class="row">
      <!-- Book Image -->
      <div class="col-md-4">
        <img src="./bootstrap/img/<?php echo $row['book_image']; ?>" alt="<?php echo $row['book_title']; ?>" class="img-fluid img-thumbnail">
      </div>

      <!-- Book Details -->
      <div class="col-md-8">
        <h2><?php echo $row['book_title']; ?></h2>
        <p class="text-muted">By: <span class="text-primary"><?php echo $row['book_author']; ?></span></p>
        <h3 class="text-danger"><?php echo getbookprice($row['book_isbn']); ?> $</h3>
        <p><strong>Publisher:</strong> <?php echo $row['publisher_name']; ?></p>
        <p><strong>Released Date:</strong> 2015</p>
        <p><strong>ISBN:</strong> <?php echo $row['book_isbn']; ?></p>
        <form method="post" action="cart.php">
          <input type="hidden" name="bookisbn" value="<?php echo $book_isbn; ?>">
          <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
        </form>



      </div>
    </div>

    <!-- Book Overview -->
    <div class="row mt-5">
      <div class="col-md-12">
        <h4>Book Overview</h4>
        <p><?php echo $row['book_descr']; ?></p>
        <p><strong>Categories:</strong> <?php echo $row['categories']; ?></p>
        <p><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
      </div>
    </div>
  <?php
  }
  if (isset($conn)) {
    mysqli_close($conn);
  }
  ?>
</div>

<?php
require_once "./template/footer.php";
?>