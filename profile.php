<?php
session_start();
$title = "My Profile";
require_once "./template/header.php";
require_once "./functions/database_functions.php";

// Check if user is logged in
if (!isset($_SESSION['customerid'])) {
    header("Location: login.php");
    exit;
}

$conn = db_connect();
$customerId = $_SESSION['customerid'];
$success_message = '';
$error_message = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    try {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $city = trim($_POST['city']);
        $zip_code = trim($_POST['zip_code']);
        $country = trim($_POST['country']);
        
        // Validate inputs
        if (empty($name) || empty($address) || empty($city) || empty($zip_code) || empty($country)) {
            throw new Exception("All fields are required");
        }
        
        // Update customer details
        $query = "UPDATE customers SET 
                 name = ?, 
                 address = ?, 
                 city = ?, 
                 zip_code = ?, 
                 country = ? 
                 WHERE customerid = ?";
                 
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $address, $city, $zip_code, $country, $customerId);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['name'] = $name; // Update session name
            $success_message = "Profile updated successfully!";
        } else {
            throw new Exception("Failed to update profile");
        }
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

// Get current user details
$query = "SELECT * FROM customers WHERE customerid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $customerId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customer = mysqli_fetch_assoc($result);

require_once "./template/sidebar.php";
?>

<!-- Main content -->
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Profile</h3>
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

            <form method="post" action="profile.php">
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo htmlspecialchars($customer['name']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" 
                           value="<?php echo htmlspecialchars($customer['address']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" 
                           value="<?php echo htmlspecialchars($customer['city']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="zip_code">ZIP Code:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" 
                           value="<?php echo htmlspecialchars($customer['zip_code']); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" name="country" 
                           value="<?php echo htmlspecialchars($customer['country']); ?>" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="update_profile" class="btn btn-primary">
                        Update Profile
                    </button>
                </div>
            </form>

            <hr>

            
        </div>
    </div>
</div>

<?php
if(isset($conn)) {
    mysqli_close($conn);
}
require_once "./template/footer.php";
?>