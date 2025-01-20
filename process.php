<?php   
session_start();
require_once "./functions/database_functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get customer input from the form
    $customername = $_SESSION['name'];
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $zip_code = trim($_POST['zip_code']);
    $country = trim($_POST['country']);
    // if ($customername != null){
    //     echo $customername;
    //     exit;
    // }
    
    // // Validate the inputs
    // if (empty($customername) || empty($address) || empty($city) || empty($zip_code) || empty($country)) {
    //     $_SESSION['err'] = 1; // Set error flag
    //     header("Location: purchase.php"); // Redirect back to purchase page
    //     exit;
    // }
    
    // Connect to the database
    $conn = db_connect();

    // Retrieve or create customer ID
    $customer_id = updateCustomerDetails($conn, $customername, $address, $city, $zip_code, $country);
   $customer_id  = $_SESSION['customerid'];

    // Insert order data into the `orders` table
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $order_date = date("Y-m-d H:i:s");
    $total_price = $_SESSION['total_price'];
    insertIntoOrder($customer_id, $total_price, $order_date, $customername, $address, $city, $zip_code, $country);

    // Retrieve the order ID
    $order_id = getLatestOrderId($conn, $customer_id);
    //echo $order_id to debug 
    if(!$order_id){
        echo "Order ID not found!";
        exit;
    }
    // Insert each cart item into the `order_items` table
    foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO order_items VALUES 
		('$order_id', '$isbn', '$bookprice', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn2);
			exit;
		}
	}

    // Clear the cart session
    unset($_SESSION['cart']);
    unset($_SESSION['total_items']);
    unset($_SESSION['total_price']);
   

    // Redirect to a success page or confirmation page
    header("Location: order_success.php");
    exit;
} else {
    // If accessed directly, redirect to the cart page
    header("Location: cart.php");
    exit;
}
?>