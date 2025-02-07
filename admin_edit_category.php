<?php
    session_start();
    require_once "./functions/admin.php";
    $title = "Edit Publisher";
    require_once "./template/header.php";
    require_once "./functions/database_functions.php";
    require_once "./template/sidebar_admin.php";
    $conn = db_connect();

    if (isset($_GET['catid'])) {
        $catid = $_GET['catid'];
    } else {
        echo "Empty query!";
        exit;
    }

    if (!isset($catid)) {
        echo "Empty publisher ID! Check again!";
        exit;
    }

    // Get publisher data
    $query = "SELECT * FROM categories WHERE category_id = '$catid'";
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
            <th>Category ID</th>
            <td><?php echo htmlspecialchars($row['category_id']); ?></td>
        </tr>
        <tr>
            <th>Category Name</th>
            <td><input type="text" name="cat_name" value="<?php echo htmlspecialchars($row['category']); ?>" required></td>
        </tr>
    </table>
    <input type="submit" name="save_change" value="Save Changes" class="btn btn-primary">
    <a href="admin_publisher.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
    if (isset($_POST['save_change'])) {
        $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

        $update_query = "UPDATE categories SET category = '$cat_name' WHERE category_id = '$catid'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "<div class='alert alert-success'>Category name updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating publisher: " . mysqli_error($conn) . "</div>";
        }
    }

    if (isset($conn)) {
        mysqli_close($conn);
    }

    require_once "./template/footer.php";
?>
