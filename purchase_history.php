<?php
// First, let's improve the getcustomerpurchaseorder function to be more secure and include order details


session_start();

// Verify user is logged in
if(!isset($_SESSION['customerid'])) {
    header("Location: login.php");
    exit;
}

$title = "Purchase History";
require_once "./template/header.php";
require_once "./functions/database_functions.php";

try {
    $conn = db_connect();
    $result = getcustomerpurchaseorder($conn, $_SESSION['customerid']);
    
    // Group orders by orderid
    $orders = [];
    while($row = mysqli_fetch_assoc($result)) {
        $orderid = $row['orderid'];
        if(!isset($orders[$orderid])) {
            $orders[$orderid] = [
                'order_date' => $row['date'],
                'total_price' => $row['amount'],
                'shipping_address' => $row['ship_address'] . ', ' . $row['ship_city'] . ', ' . $row['ship_zip_code'] . ', ' . $row['ship_country'],
                'items' => []
            ];
        }
        if($row['book_isbn']) {
            $orders[$orderid]['items'][] = [
                'isbn' => $row['book_isbn'],
                'title' => $row['book_title'],
                'image' => $row['book_image'],
                'price' => $row['item_price'],
                'quantity' => $row['quantity']
            ];
        }
    }
    
    require_once "./template/sidebar.php";
?>

<!-- Main content -->
<div id="main-content" class="col-md-9">
    <h2 class="text-center">Purchase History</h2>
    
    <?php if(empty($orders)): ?>
        <div class="alert alert-info">
            You haven't made any purchases yet.
        </div>
    <?php else: ?>
        <?php foreach($orders as $orderid => $order): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Order ID:</strong> <?php echo htmlspecialchars($orderid); ?><br>
                            <strong>Date:</strong> <?php echo date('F j, Y g:i A', strtotime($order['order_date'])); ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <strong>Total:</strong> $<?php echo number_format($order['total_price'], 2); ?><br>
                            <small>Shipped to: <?php echo htmlspecialchars($order['shipping_address']); ?></small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach($order['items'] as $item): ?>
                            <div class="col-md-3 mb-3">
                                <div class="text-center">
                                    <a href="book_detail.php?bookisbn=<?php echo htmlspecialchars($item['isbn']); ?>">
                                        <img class="img-thumbnail mb-2" 
                                             src="./bootstrap/img/<?php echo htmlspecialchars($item['image']); ?>"
                                             alt="<?php echo htmlspecialchars($item['title']); ?>"
                                             style="max-height: 150px;">
                                    </a>
                                    <div>
                                        <small><?php echo htmlspecialchars($item['title']); ?></small><br>
                                        <small>Qty: <?php echo $item['quantity']; ?> × $<?php echo number_format($item['price'], 2); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
} catch (Exception $e) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($e->getMessage()) . '</div>';
} finally {
    if(isset($conn)) {
        mysqli_close($conn);
    }
}

require_once "./template/footer.php";
?>