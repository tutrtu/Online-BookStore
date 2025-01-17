 <!-- sidebar.php -->
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="sidebar">
        <div class="list-group">
          <h3 class="list-group-item active">My Account</h3>
          <a href="edit_profile.php" class="list-group-item">
            <span class="glyphicon glyphicon-user"></span> Edit Profile
          </a>
          <a href="my_books.php" class="list-group-item">
            <span class="glyphicon glyphicon-book"></span> My Books
          </a>
          <a href="purchase_history.php" class="list-group-item">
            <span class="glyphicon glyphicon-shopping-cart"></span> My Purchases
          </a>
          <a href="logout.php" class="list-group-item">
            <span class="glyphicon glyphicon-log-out"></span> Sign Out
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">

    <style>
.sidebar {
    padding: 20px 0;
}

.sidebar .list-group {
    margin-bottom: 20px;
}

.sidebar .list-group-item.active {
    background-color: #337ab7;
    border-color: #337ab7;
}

.sidebar .list-group-item .glyphicon {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .sidebar {
        margin-bottom: 20px;
    }
}
</style>