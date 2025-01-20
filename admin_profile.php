<?php
session_start();
$title = "Admin Profile";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";

// Check if user is logged in as admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}

$conn = db_connect();
$success_message = '';
$error_message = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Check current password
    $check_query = "SELECT name, pass FROM admin WHERE name='" . $_SESSION['admin_name'] . "'";
    $check_result = mysqli_query($conn, $check_query);
    
    if(!$check_result){
        $error_message = "Can't retrieve data " . mysqli_error($conn);
    } else {
        $admin = mysqli_fetch_assoc($check_result);
        
        if (!$admin || !password_verify($current_password, $admin['pass'])) {
            $error_message = "Current password is incorrect";
        } else {
            // If new password provided, validate it
            if (!empty($new_password)) {
                if (strlen($new_password) < 8) {
                    $error_message = "New password must be at least 8 characters long";
                } elseif ($new_password !== $confirm_password) {
                    $error_message = "New passwords do not match";
                } else {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_query = "UPDATE admin SET 
                                   name='" . $name . "',
                                   pass='" . $hashed_password . "'
                                   WHERE name='" . $_SESSION['admin_name'] . "'";
                }
            } else {
                // Only update name
                $update_query = "UPDATE admin SET 
                               name='" . $name . "'
                               WHERE name='" . $_SESSION['admin_name'] . "'";
            }
            
            // Execute update if no errors
            if (empty($error_message)) {
                $update_result = mysqli_query($conn, $update_query);
                if ($update_result) {
                    $_SESSION['admin_name'] = $name;
                    $success_message = "Profile updated successfully!";
                } else {
                    $error_message = "Failed to update profile: " . mysqli_error($conn);
                }
            }
        }
    }
}

// Get current admin details
$query = "SELECT name FROM admin WHERE name='" . $_SESSION['admin_name'] . "'";
$result = mysqli_query($conn, $query);
if(!$result){
    $error_message = "Can't retrieve data " . mysqli_error($conn);
    $admin = array('name' => $_SESSION['admin_name']); // Fallback value
} else {
    $admin = mysqli_fetch_assoc($result);
}
?>

<!-- Main content -->
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin Profile</h3>
        </div>
        <div class="card-body">
            <?php if ($success_message): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin_profile.php">
                <div class="form-group mb-3">
                    <label for="name">Admin Name:</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo htmlspecialchars($admin['name']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="current_password">Current Password:</label>
                    <input type="password" class="form-control" id="current_password" 
                           name="current_password" required>
                </div>

                <div class="form-group mb-3">
                    <label for="new_password">New Password (leave blank to keep current):</label>
                    <input type="password" class="form-control" id="new_password" 
                           name="new_password" minlength="8">
                    <small class="form-text text-muted">Minimum 8 characters</small>
                </div>

                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" class="form-control" id="confirm_password" 
                           name="confirm_password">
                </div>

                <div class="form-group">
                    <button type="submit" name="update_profile" class="btn btn-primary">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>