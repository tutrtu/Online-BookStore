<?php
	
	$title = "user section";
	require_once "./template/header.php";
	include "./functions/database_functions.php";
?>

	<form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
		<div class="form-group">
			<label for="name" class="control-label col-md-4">Name</label>
			<div class="col-md-4">
				<input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="pass" class="control-label col-md-4">Pass</label>
			<div class="col-md-4">
				<input type="password" name="pass" class="form-control">
			</div>
		</div>
		<input type="submit" name="login" class="btn btn-primary">
	</form>
    <p>Don't have an account? <a href="user_register.php">Register here</a></p>


    
<?php
	require_once "./template/footer.php";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

    if ($name && $pass) {
        $conn = db_connect();

        // SQL query to find the user
        $sql = "SELECT * FROM customers WHERE name = '$name' AND password = '$pass'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($result && mysqli_num_rows($result) == 1) {
            $_SESSION['user'] = true;
            $_SESSION['name'] = $name; // Store the user's name in the session
            $customer_id = $row['customerid'];
            $_SESSION['customerid'] = $customer_id;
            header("Location: index.php");
			echo "<p>Login successful. Welcome, " . $_SESSION['name'] . "!</p>"; // Debugging: Print session name
			echo 
            exit;
        } else {
            $_SESSION['user'] = false;
            echo "Name or password is incorrect. Please try again.";
        }

        // Close the connection
        mysqli_close($conn);
    } else {
        echo "Please fill in all fields.";
    }
}
?>

