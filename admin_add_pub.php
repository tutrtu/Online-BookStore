<?php 
session_start(); 
require_once "./functions/admin.php"; 
$title = "Add Publisher"; 
require_once "./template/header.php"; 
require_once "./functions/database_functions.php";  
require_once "./template/sidebar_admin.php";

// Check session for admin authentication 
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {     
    header("Location: index.php");     
    exit; 
} 
$conn = db_connect(); 
?>  

<div class="container">     
    <h4 class="fw-bolder text-center">Add New Publisher</h4>     
    <hr>     
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">         
        <table class="table">             
            <tr>                 
                <th style="width: 150px;">Publisher Name</th>                 
                <td>
                    <input type="text" name="publisher_name" class="form-control" style="max-width: 300px;" required>
                </td>             
            </tr>             
            <tr>                 
                <td></td>                 
                <td><input type="submit" name="add" value="Add Publisher" class="btn btn-primary"></td>             
            </tr>         
        </table>     
    </form> 
</div>  

<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add'])) {     
    // Sanitize input     
    $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);      
    
    // Validate required fields     
    if (empty($publisher_name)) {         
        echo "<p class='text-danger'>Publisher name is required.</p>";     
    } else {         
        // Check if publisher already exists         
        $check_query = "SELECT * FROM publisher WHERE publisher_name = '$publisher_name'";         
        $check_result = mysqli_query($conn, $check_query);                  
        
        if(mysqli_num_rows($check_result) > 0) {             
            echo "<p class='text-danger'>Publisher already exists.</p>";         
        } else {             
            // Insert into database             
            $query = "INSERT INTO publisher (publisher_name) VALUES ('$publisher_name')";                          
            
            if (mysqli_query($conn, $query)) {                 
                echo "<p class='text-success'>Publisher added successfully.</p>";             
            } else {                 
                echo "<p class='text-danger'>Error adding publisher: " . mysqli_error($conn) . "</p>";             
            }         
        }     
    } 
}  

require_once "./template/footer.php";  

if (isset($conn)) {     
    mysqli_close($conn); 
} 
?>