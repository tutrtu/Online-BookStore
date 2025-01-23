<?php
    session_start();
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    $query = "SELECT * FROM categories ORDER BY category_id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "Empty category! Something wrong! check again";
        exit;
    }
    $result2 = getCategoryWithBookCount($conn);
    $title = "List Of Categories";
    require "./template/header.php";
?>
    <p class="lead">List of Categories</p>
    <ul>
    <?php 
        while($row = mysqli_fetch_assoc($result2)){
            
    ?>
        <li>
            <span class="badge"><?php echo $row['book_count']; ?></span>
            <a href="bookPerCate.php?catname=<?php echo $row['category']; ?>"><?php echo $row['category']; ?></a>
        </li>
    <?php } ?>
        <li>
            <a href="book.php">List full of books</a>
        </li>
    </ul>
<?php
    mysqli_close($conn);
    require "./template/footer.php";
?>
