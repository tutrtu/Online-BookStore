<?php
session_start();
require_once "./functions/admin.php";
$title = "List book";
require_once "./template/header.php";
require_once "./functions/database_functions.php";
require_once "./template/sidebar_admin.php";
//check session
// Check session for admin authentication
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: index.php");
    exit;
}
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
        <!-- Categories Multiselect -->
    <tr>
        <th>Categories</th>
        <td>
            <select name="categories[]" class="form-multi-select" id="ms1" multiple data-coreui-search="global">
                <?php
                $categories = getAllCategories($conn);
                foreach ($categories as $category) {
                    echo "<option value=\"" . $category['category_id'] . "\">" 
                         . $category['category'] . "</option>";
                }
                ?>
            </select>
        </td>
    </tr>
    
    <!-- Tags Multiselect -->
    <tr>
        <th>Tags</th>
        <td>
            <select name="tags[]" multiple required>
                <?php
                $tags = getAllTags($conn);
                foreach ($tags as $tag) {
                    echo "<option value=\"" . $tag['tag_id'] . "\">" 
                         . $tag['tag_name'] . "</option>";
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

        // Start a database transaction for data integrity
        mysqli_begin_transaction($conn);

        try {
            // Insert book details
            $query = "INSERT INTO books (book_isbn, book_title, book_author, book_descr, book_price, book_image, publisherid) 
                      VALUES ('$isbn', '$title', '$author', '$descr', '$price', '$image', '$publisher')";
            
            if (!mysqli_query($conn, $query)) {
                throw new Exception("Error adding book: " . mysqli_error($conn));
            }

            // Insert Categories
            if (isset($_POST['categories']) && is_array($_POST['categories'])) {
                foreach ($_POST['categories'] as $category_id) {
                    $category_query = "INSERT INTO book_categories (book_isbn, category_id) 
                                       VALUES ('$isbn', '$category_id')";
                    if (!mysqli_query($conn, $category_query)) {
                        throw new Exception("Error adding categories: " . mysqli_error($conn));
                    }
                }
            }

            // Insert Tags
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                foreach ($_POST['tags'] as $tag_id) {
                    $tag_query = "INSERT INTO book_tags (book_isbn, tag_id) 
                                  VALUES ('$isbn', '$tag_id')";
                    if (!mysqli_query($conn, $tag_query)) {
                        throw new Exception("Error adding tags: " . mysqli_error($conn));
                    }
                }
            }

            // Commit the transaction
            mysqli_commit($conn);
            echo "<p class='text-success'>Book added successfully with categories and tags.</p>";

        } catch (Exception $e) {
            // Rollback the transaction on any error
            mysqli_rollback($conn);
            echo "<p class='text-danger'>" . $e->getMessage() . "</p>";
        }
    }
}

if (isset($conn)) {
    mysqli_close($conn);
}
?>
