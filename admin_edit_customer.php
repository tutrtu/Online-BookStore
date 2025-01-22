<?php
session_start();
require_once "./functions/admin.php";
$title = "Edit Publisher";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";
$conn = db_connect();

if (isset($_GET['id'])) {
    $cusid = mysqli_real_escape_string($conn, $_GET['id']);
} else {
    echo "Empty query!";
    exit;
}

// Get publisher data
$query = "SELECT * FROM customers WHERE customerid = '$cusid'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't retrieve data: " . mysqli_error($conn);
    exit;
}
$row = mysqli_fetch_assoc($result);
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $cusid); ?>" >
    <table class="table">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($row['customerid']); ?></td>
        </tr>
        <tr>
            <th>Customer Name</th>
            <td><input type="text" name="customer_name" value="<?php echo htmlspecialchars($row['name']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer Password</th>
            <td><input type="text" name="customer_password" value="<?php echo htmlspecialchars($row['password']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer Phone</th>
            <td><input type="text" name="customer_phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer Address</th>
            <td><input type="text" name="customer_address" value="<?php echo htmlspecialchars($row['address']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer City</th>
            <td><input type="text" name="customer_city" value="<?php echo htmlspecialchars($row['city']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer ZIP Code</th>
            <td><input type="text" name="customer_zip_code" value="<?php echo htmlspecialchars($row['zip_code']); ?>" required></td>
        </tr>
        <tr>
            <th>Customer Country</th>
            <td><input type="text" name="customer_country" value="<?php echo htmlspecialchars($row['country']); ?>" required></td>
        </tr>
    </table>
    <input type="submit" name="save_change" value="Save Changes" class="btn btn-primary">
    <a href="admin_user.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
if (isset($_POST['save_change'])) {
    $customer_name = mysqli_real_escape_string($conn, trim($_POST['customer_name']));
    $customer_password = mysqli_real_escape_string($conn, trim($_POST['customer_password']));
    $customer_phone = mysqli_real_escape_string($conn, trim($_POST['customer_phone']));
    $customer_address = mysqli_real_escape_string($conn, trim($_POST['customer_address']));
    $customer_city = mysqli_real_escape_string($conn, trim($_POST['customer_city']));
    $customer_zip_code = mysqli_real_escape_string($conn, trim($_POST['customer_zip_code']));
    $customer_country = mysqli_real_escape_string($conn, trim($_POST['customer_country']));

    // Check if all fields are filled
    if (empty($customer_name) || empty($customer_password) || empty($customer_phone) || 
        empty($customer_address) || empty($customer_city) || empty($customer_zip_code) || 
        empty($customer_country)) {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        // Update customer information
        $query = "UPDATE customers SET 
                  name = '$customer_name',
                  password = '$customer_password',
                  phone = '$customer_phone',
                  address = '$customer_address',
                  city = '$customer_city',
                  zip_code = '$customer_zip_code',
                  country = '$customer_country'
                  WHERE customerid = '$cusid'";

        $result = mysqli_query($conn, $query);
        if ($result) {
            // If customer is also an admin, update admin table
            $check_admin = "SELECT * FROM admin WHERE name = '$customer_name'";
            $admin_result = mysqli_query($conn, $check_admin);
            if (mysqli_num_rows($admin_result) > 0) {
                $update_admin = "UPDATE admin SET pass = '$customer_password' WHERE name = '$customer_name'";
                mysqli_query($conn, $update_admin);
            }
            
            echo "<div class='alert alert-success'>Customer information updated successfully!</div>";
            // Redirect after 2 seconds
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'admin_user.php';
                    }, 2000);
                  </script>";
        } else {
            echo "<div class='alert alert-danger'>Error updating customer information: " . mysqli_error($conn) . "</div>";
        }
    }
}

if (isset($conn)) {
    mysqli_close($conn);
}

require_once "./template/footer.php";
?>