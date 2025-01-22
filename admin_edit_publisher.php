<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "Edit Publisher";
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";
    require_once "./template/sidebar_admin.php";
    $conn = db_connect();

    if (isset($_GET['publisherid'])) {
        $publisherid = $_GET['publisherid'];
    } else {
        echo "Empty query!";
        exit;
    }

    if (!isset($publisherid)) {
        echo "Empty publisher ID! Check again!";
        exit;
    }

    // Get publisher data
    $query = "SELECT * FROM publisher WHERE publisherid = '$publisherid'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Can't retrieve data: " . mysqli_error($conn);
        exit;
    }
    $row = mysqli_fetch_assoc($result);
?>

<form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" >
    <table class="table">
        <tr>
            <th>Publisher ID</th>
            <td><?php echo htmlspecialchars($row['publisherid']); ?></td>
        </tr>
        <tr>
            <th>Publisher Name</th>
            <td><input type="text" name="publisher_name" value="<?php echo htmlspecialchars($row['publisher_name']); ?>" required></td>
        </tr>
    </table>
    <input type="submit" name="save_change" value="Save Changes" class="btn btn-primary">
    <a href="admin_publisher.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
    if (isset($_POST['save_change'])) {
        $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);

        $update_query = "UPDATE publisher SET publisher_name = '$publisher_name' WHERE publisherid = '$publisherid'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "<div class='alert alert-success'>Publisher name updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating publisher: " . mysqli_error($conn) . "</div>";
        }
    }

    if (isset($conn)) {
        mysqli_close($conn);
    }

    require_once "./template/footer.php";
?>
