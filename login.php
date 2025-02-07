<?php
	session_start();
	$title = "Administration section";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
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
		<input type="submit" name="submit" class="btn btn-primary">
	</form>

<?php
	require_once "./template/footer.php";
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

		if($name && $pass){
			$sql = "SELECT name, pass FROM admin WHERE name = '$name' AND pass = '$pass'";



			try {
				$conn = db_connect();
				mysqli_query($conn, $sql);
				if(mysqli_affected_rows($conn) == 1){
					$_SESSION['admin'] = true;
					$_SESSION['admin_name'] = $name;
					header("Location: admin_book.php");
				} else {
					$_SESSION['admin'] = false;
					echo "Name or pass is wrong. Check again!";
				}

			} catch (mysqli_sql_exception $th) {	
				//throw $th;t
				echo "Error: " . $sql . "<br>" . $th->getMessage();
			}
		}
	}
?>