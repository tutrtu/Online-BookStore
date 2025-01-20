<?php
session_start();
require_once "./functions/admin.php";
$title = "User Management";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";

// Check session for admin authentication
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}
$conn = db_connect();

// Handle Delete Operation
if(isset($_GET['delete']) && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    if($type === 'customer') {
        $query = "DELETE FROM customers WHERE customerid = '$id'";
    } else if($type === 'admin') {
        $query = "DELETE FROM admin WHERE name = '$id'";
    }
    
    if(mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>User deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting user: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container">
    <h4 class="fw-bolder text-center">User Management</h4>
    <hr>
    
    <!-- Admin Users Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Admin Users</h5>
            <a href="admin_add_admin.php" class="btn btn-primary btn-sm">Add New Admin</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Admin Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM admin ORDER BY name";
                    $result = mysqli_query($conn, $query);
                    while($admin = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($admin['name']) . "</td>";
                        echo "<td>";
                        echo "<a href='admin_edit_admin.php?id=" . urlencode($admin['name']) . "' class='btn btn-sm btn-outline-primary me-2'><i class='bi bi-pencil'></i> Edit</a>";
                        echo "<a href='?delete=true&type=admin&id=" . urlencode($admin['name']) . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure?\")'><i class='bi bi-trash'></i> Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                   
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Customers Section -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Customers</h5>
            <div>
                <input type="text" id="customerSearch" class="form-control form-control-sm d-inline-block" style="width: 200px;" placeholder="Search customers...">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>

                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Country</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM customers ORDER BY name";
                    $result = mysqli_query($conn, $query);
                    while($customer = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($customer['name']) . "</td>";
                        
                        echo "<td>" . htmlspecialchars($customer['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($customer['city']) . "</td>";
                        echo "<td>" . htmlspecialchars($customer['zip_code']) . "</td>";
                        echo "<td>" . htmlspecialchars($customer['country']) . "</td>";
                        echo "<td>";
                        echo "<a href='admin_edit_customer.php?id=" . urlencode($customer['customerid']) . "' class='btn btn-sm btn-outline-primary me-2'><i class='bi bi-pencil'></i> Edit</a>";
                        echo "<a href='?delete=true&type=customer&id=" . urlencode($customer['customerid']) . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure?\")'><i class='bi bi-trash'></i> Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Simple search functionality for customers table
document.getElementById('customerSearch').addEventListener('keyup', function() {
    let searchText = this.value.toLowerCase();
    let customerTable = document.querySelector('.table:last-of-type tbody');
    let rows = customerTable.getElementsByTagName('tr');
    
    for(let row of rows) {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    }
});
</script>

<?php
require_once "./template/footer.php";

if(isset($conn)) {
    mysqli_close($conn);
}
?>