<?php
session_start();
require_once "./functions/admin.php";
$title = "List book";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
$conn = db_connect();
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <th>ISBN</th>
            <td><input type="text" name="isbn" required></td>
        </tr>
        <tr>
            <th>Title</th>
            <td><input type="text" name="title" required></td>
        </tr>
        <tr>
            <th>Author</th>
            <td><input type="text" name="author" required></td>
        </tr>
        <tr>
            <th>Image</th>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><textarea name="descr" cols="40" rows="5"></textarea></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><input type="text" name="price" required></td>
        </tr>
        <tr>
            <th>Publisher</th>
            <td>
                <select name="publisher" required>
                    <option value="0" selected>Select Publisher</option>
                    <?php
                    $publisher = getallpublisher($conn);
                    foreach ($publisher as $row) {
                        echo "<option value=\"" . $row['publisherid'] . "\">" . $row['publisher_name'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="add" value="Add new book" class="btn btn-primary"></td>
        </tr>
    </table>
</form>

<?php
require_once "./template/footer.php";
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize and validate input
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $descr = mysqli_real_escape_string($conn, $_POST['descr']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);

    // Validate required fields
    if (empty($isbn) || empty($title) || empty($author) || empty($price) || $publisher == 0) {
        echo "<p class='text-danger'>All fields except image are required.</p>";
    } else {
        // Handle image upload
        $upload_dir = './bootstrap/img/';
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = $upload_dir . basename($image);

        if (!empty($image)) {
            if (move_uploaded_file($image_tmp, $image_path)) {
                echo "<p class='text-success'>Image uploaded successfully.</p>";
            } else {
                echo "<p class='text-danger'>Image upload failed.</p>";
                $image = null; // Keep null if upload fails
            }
        } else {
            $image = null; // No image uploaded
        }

        // Insert into database using mysqli
        $query = "INSERT INTO books (book_isbn, book_title, book_author, book_descr, book_price, book_image, publisherid) 
                  VALUES ('$isbn', '$title', '$author', '$descr', '$price', '$image', '$publisher')";

        if (mysqli_query($conn, $query)) {
            echo "<p class='text-success'>Book added successfully.</p>";
        } else {
            echo "<p class='text-danger'>Error adding book: " . mysqli_error($conn) . "</p>";
        }
    }
}

if (isset($conn)) {
    mysqli_close($conn);
}
?>
