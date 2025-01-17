<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
  require_once "./template/sidebar.php";
?>


<!-- Main content starts here -->
<div id="main-content">
  <p class="lead text-center text-muted">Latest books</p>
  <div class="row">
    <?php foreach($row as $book) { ?>
      <div class="col-md-3">
        <a href="book_detail.php?bookisbn=<?php echo $book['book_isbn']; ?>">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
        </a>
      </div>
    <?php } ?>
  </div>
</div>

</div><!-- Close col-md-9 from sidebar -->
</div><!-- Close row from sidebar -->
</div><!-- Close container-fluid from sidebar -->
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>