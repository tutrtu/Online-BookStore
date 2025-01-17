<?php
session_start();
$title = "user section";
require_once "./template/header.php";
include "./functions/database_functions.php";
?>

<form class="form-horizontal" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <div class="form-group">
        <label for="first_name" class="control-label col-md-4">First Name</label>
        <div class="col-md-4">
            <input type="text" name="first_name" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="control-label col-md-4">Last Name</label>
        <div class="col-md-4">
            <input type="text" name="last_name" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="control-label col-md-4">Phone</label>
        <div class="col-md-4">
            <input type="text" name="phone" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="pass" class="control-label col-md-4">Password</label>
        <div class="col-md-4">
            <input type="password" name="pass" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="confirm_pass" class="control-label col-md-4">Confirm Password</label>
        <div class="col-md-4">
            <input type="password" name="confirm_pass" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <input type="submit" name="register" value="Register" class="btn btn-primary">
        </div>

</form>



<?php
require_once "./template/footer.php";
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $name = //first name + last name

    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_pass', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    $name = strtolower($first_name . $last_name);
    if ($password != $confirm_password) {
        echo "Password does not match";
    } else {
        $conn = db_connect();
        $sql = "INSERT INTO customers(name, password, phone) VALUES('$name', '$password', '$phone')";
        try {
            mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn) == 1) {
                $_SESSION['user'] = true;
                $_SESSION['name'] = $name;
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['user'] = false;
                echo "Name or pass is wrong. Check again!";
            }
        } catch (mysqli_sql_exception $th) {
            //throw $th;t
            echo "Error: " . $sql . "<br>" . $th->getMessage();
        }
    }

    mysqli_close($conn);
}



?>