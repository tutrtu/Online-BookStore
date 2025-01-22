<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  $count = 0;
  

  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $result = getBookByIsbn($conn, $book_isbn);
?>
      <!-- Example row of columns -->
        <p class="lead text-center text-muted">Book Detail</p>
        <?php
          if(mysqli_num_rows($result) == 0) {
            echo "<p class=\"text-danger\">We are sorry, but the book is not available.</p>";
          } else {
            $row = mysqli_fetch_assoc($result);
        ?>
        <table class="table">
          <tr>
            <td>Image</td>
            <td><img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>"></td>
          </tr>
          <tr>
            <td>ISBN</td>
            <td><?php echo $row['book_isbn']; ?></td>
          </tr>
          <tr>
            <td>Title</td>
            <td><?php echo $row['book_title']; ?></td>
          </tr>
          <tr>
            <td>Author</td>
            <td><?php echo $row['book_author']; ?></td>
          </tr>
          <tr>
            <td>Description</td>
            <td><?php echo $row['book_descr']; ?></td>
          </tr>
          <tr>
            <td>Publisher</td>
            <td><?php echo getPubName($conn, $row['publisherid']); ?></td>
          </tr>
          
          <tr>
            <td>Price</td>
            <td><?php echo getbookprice($row['book_isbn']); ?></td>
          </tr>
          <tr>
            <td>Publisher</td>
            <td><?php echo $row['publisher_name']; ?></td>
          </tr>
        </table>
        <?php
          }
        ?>
        <form method="post" action="cart.php">
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <input type="submit" value="Purchase / Add to cart" name="cart" class="btn btn-primary">
          </form>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>