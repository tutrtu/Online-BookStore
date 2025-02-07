<?php
	$tagid = $_GET['tagid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM tags WHERE tag_id = '$tagid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: admin_categories.php");
?>