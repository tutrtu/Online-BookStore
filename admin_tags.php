<?php
session_start();
// require_once "./functions/admin.php";
$title = "List book";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";
$conn = db_connect();
$result = getAllTags($conn);
?>
<p class="lead text-end"><a href="admin_add_pub.php">Add new tag</a></p>
<h2 class="text-end">List of tags</h2>
<table class="table" style="margin-top: 20px">
    <tr>
        <th>Tag</th>
        <th class="text-end">Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['tag_name']; ?></td>
            <td class="text-end">
                <a href="admin_edit_tag.php?tagid=<?php echo $row['tag_id']; ?>"
                    class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="admin_delete_tag.php?tagid=<?php echo $row['tag_id']; ?>"
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this tag?');">
                    <i class="bi bi-trash"></i> Delete
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>