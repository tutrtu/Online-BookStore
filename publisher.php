<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = getAllPub($conn);
?>
      <!-- Example row of columns -->
      <h1>Publisher List</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($row as $pub) { ?>
            <tr>
                <td><?php echo $pub['publisherid']; ?></td>
                <td><?php echo $pub['publisher_name']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>