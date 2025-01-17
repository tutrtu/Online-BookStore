<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?></title>

  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CSE Bookstore</a>
      </div>

      <!--/.navbar-collapse -->
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <!-- link to publisher_list.php -->
          <li><a href="publisher.php"><span class="glyphicon glyphicon-paperclip"></span>&nbsp; Publisher</a></li>
          <!-- link to books.php -->
          <li><a href="book.php"><span class="glyphicon glyphicon-book"></span>&nbsp; Books</a></li>
          <!-- link to contacts.php -->
          <li><a href="contact.php"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; Contact</a></li>
          <!-- link to shopping cart -->
          <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; My Cart</a></li>
          <li>
            <!-- PHP login/logout logic -->
            <?php if (isset($_SESSION['user']) && $_SESSION['user']): ?>
              <a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp; Logout</a>
            <?php else: ?>
              <a href="user_login.php"><span class="glyphicon glyphicon-user"></span>&nbsp; Login</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
  if (isset($title) && $title == "Index") {
  ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" id="main-content">
      <div class="container">
        <h1>Welcome to online CSE bookstore</h1>
        <p class="lead"></p>
        <p>The layout use Bootstrap to make it more responsive. It's just a simple web!</p>
        <pre><?php print_r($_SESSION); ?></pre>
        <?php
        if (isset($_SESSION['name'])) {
        ?>
          <p>Hi <?php echo $_SESSION['name']; ?></p>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <div class="container" id="main">