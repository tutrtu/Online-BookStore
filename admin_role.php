<?php
session_start();
require_once "./functions/admin.php";
$title = "User Role Management";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";

// Check session for admin authentication
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}
$conn = db_connect();

// Handle role change
if(isset($_GET['toggle_role']) && isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $current_role = mysqli_real_escape_string($conn, $_GET['current_role']);
    
    if($current_role === 'user') {
        // Change from user to admin
        // First copy user data to admin table
        $query = "INSERT INTO admin (name, pass) 
                 SELECT name, password FROM customers 
                 WHERE customerid = '$user_id'";
        if(mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>User promoted to admin successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error changing role: " . mysqli_error($conn) . "</div>";
        }
    } else {
        // Change from admin to user
        // First check if this is not the last admin
        $check_query = "SELECT COUNT(*) as admin_count FROM admin";
        $result = mysqli_query($conn, $check_query);
        $row = mysqli_fetch_assoc($result);
        
        if($row['admin_count'] <= 1) {
            echo "<div class='alert alert-danger'>Cannot remove the last admin!</div>";
        } else {
            // Delete from admin table
            $query = "DELETE FROM admin WHERE name = (SELECT name FROM customers WHERE customerid = '$user_id')";
            if(mysqli_query($conn, $query)) {
                echo "<div class='alert alert-success'>Admin changed to regular user successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error changing role: " . mysqli_error($conn) . "</div>";
            }
        }
    }
}
?>

<div class="container">
    <h4 class="fw-bolder text-center">User Role Management</h4>
    <hr>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users and Roles</h5>
            <input type="text" id="userSearch" class="form-control form-control-sm" style="width: 200px;" placeholder="Search users...">
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        
                        <th>Current Role</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get all customers and their roles
                    $query = "SELECT 
                                c.customerid,
                                c.name,
                                
                                CASE 
                                    WHEN a.name IS NOT NULL THEN 'Admin'
                                    ELSE 'User'
                                END as role
                             FROM customers c
                             LEFT JOIN admin a ON c.name = a.name
                             ORDER BY c.name";
                             
                    $result = mysqli_query($conn, $query);
                    while($user = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                        
                        if($user['role'] === 'Admin') {
                            echo "<span class='badge bg-primary'>Admin</span>";
                        } else {
                            echo "<span class='badge bg-secondary'>User</span>";
                        }
                        echo "</td>";
                        echo "<td>";
                        if($user['role'] === 'Admin') {
                            echo "<a href='?toggle_role=1&id=" . $user['customerid'] . "&current_role=admin' 
                                    class='btn btn-sm btn-warning' 
                                    onclick='return confirm(\"Remove admin privileges from this user?\")'>
                                    Make User
                                 </a>";
                        } else {
                            echo "<a href='?toggle_role=1&id=" . $user['customerid'] . "&current_role=user' 
                                    class='btn btn-sm btn-success' 
                                    onclick='return confirm(\"Grant admin privileges to this user?\")'>
                                    Make Admin
                                 </a>";
                        }
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
// Simple search functionality
document.getElementById('userSearch').addEventListener('keyup', function() {
    let searchText = this.value.toLowerCase();
    let userTable = document.querySelector('.table tbody');
    let rows = userTable.getElementsByTagName('tr');
    
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