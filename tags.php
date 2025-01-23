<?php
    session_start();
    require_once "./functions/database_functions.php";
    $conn = db_connect();

    $query = "SELECT * FROM tags ORDER BY tag_id";
    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    if(mysqli_num_rows($result) == 0){
        echo "Empty tag! Something wrong! check again";
        exit;
    }
    
    $title = "List Of Tags";
    require "./template/header.php";
?>
    <p class="lead">List of Tags</p>
    <ul>
    <?php 
        while($row = mysqli_fetch_assoc($result)){
            $tagId = $row['tag_id'];
            $query = "SELECT COUNT(*) AS count FROM tags WHERE tag_id = '$tagId'";
            $result2 = mysqli_query($conn, $query);
            if(!$result2){
                echo "Can't retrieve datca " . mysqli_error($conn);
                exit;
            }
            $count = mysqli_fetch_assoc($result2)['count'];
    ?>
        <li>
            <span class="badge"><?php echo $count; ?></span>
            <a href="bookPerTag.php?tagname=<?php echo $row['tag_name']; ?>"><?php echo $row['tag_name']; ?></a>
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
