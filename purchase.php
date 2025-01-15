<?php
session_start();
require_once "./functions/database_functions.php";

// Print out header here
$title = "Purchase";
require "./template/header.php";

if (isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])) {
?>
    <table class="table">
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $isbn => $qty) {
            $conn = db_connect();
            $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
        ?>
            <tr>
                <td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
                <td><?php echo "$" . $book['book_price']; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo "$" . ($qty * $book['book_price']); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th><?php echo $_SESSION['total_items']; ?></th>
            <th><?php echo "$" . $_SESSION['total_price']; ?></th>
        </tr>
    </table>

    <form method="post" action="process.php" class="form-horizontal">
        <?php if (isset($_SESSION['err']) && $_SESSION['err'] == 1) { ?>
            <p class="text-danger">All fields have to be filled</p>
        <?php } ?>

        <div class="form-group">
            <label for="name" class="control-label col-md-4">Name</label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="control-label col-md-4">Address</label>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="city" class="control-label col-md-4">City</label>
            <div class="col-md-4">
                <input type="text" name="city" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="zip_code" class="control-label col-md-4">Zip Code</label>
            <div class="col-md-4">
                <input type="text" name="zip_code" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="country" class="control-label col-md-4">Country</label>
            <div class="col-md-4">
                <input type="text" name="country" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Purchase" class="btn btn-primary">
        </div>
    </form>

    <form action="vnpay_create_payment.php" method="POST">
        <input type="hidden" name="sotien" id="sotien" value="<?php echo $_SESSION['total_price']; ?>">
        <button type="submit" name="redirect" class="btn btn-primary thanhtoan" data-bs-toggle="modal" data-bs-target="#thanhtoan">
            Thanh toán Vnpay
        </button>
    </form>

    <p class="lead">
        Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.
    </p>
<?php
} else {
    echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
}
if (isset($conn)) {
    mysqli_close($conn);
}

require_once "./template/footer.php";
?>
