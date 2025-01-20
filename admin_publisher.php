<?php
session_start();
// require_once "./functions/admin.php";
$title = "List book";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";
$conn = db_connect();
$result = getAllPub($conn);
?>
<p class="lead"><a href="admin_add_pub.php">Add new publisher</a></p>
<h2>List of publisher</h2>
<table class="table" style="margin-top: 20px">
    <tr>
        <th>Publisher</th>
        <th class="text-end">Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['publisher_name']; ?></td>
            <td class="text-end">
                <a href="admin_edit_publisher.php?publisherid=<?php echo $row['publisherid']; ?>"
                    class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="admin_delete_publisher.php?publisherid=<?php echo $row['publisherid']; ?>"
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this publisher?');">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>x
        </tr>
    <?php } ?>
</table>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>