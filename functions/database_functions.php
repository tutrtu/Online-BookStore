<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "", "book_store");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function select4LatestBook($conn){
		$row = array();
		$query = "SELECT book_isbn, book_image FROM books ORDER BY book_isbn DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 4; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}

	function getOrderId($conn, $customerid){
		$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}

	function getBookByIsbn($conn, $isbn){
		$query = "SELECT * FROM books JOIN publisher ON books.publisherid = publisher.publisherid WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}


	function getbookprice($isbn){
		$conn = db_connect();
		$query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['book_price'];
	}


	function getCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		// $name = "tranbala";
		// if(empty($name)){
		// 	echo "name fields have to be filled";
		// 	exit;
		// }
		
		
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['customerid'];
		} else {
			return null;
		}
	}

	function updateCustomerDetails($conn, $customername, $address, $city, $zip_code, $country) {
		// Check if customer exists
		 // Check if customer exists
		 $check_query = "SELECT customerid FROM customers WHERE name = '$customername'";
		 $result = mysqli_query($conn, $check_query);
		 
		 if(!$result){
			 echo "Query failed! " . mysqli_error($conn);
			 exit;
		 }
		 
		 if(mysqli_num_rows($result) > 0) {
			 // Customer exists - get their ID
			 $row = mysqli_fetch_assoc($result);
			 $customer_id = $row['customerid'];
			 
			 // Update their details
			 $update_query = "UPDATE customers SET 
				 address = '$address',
				 city = '$city',
				 zip_code = '$zip_code',
				 country = '$country'
				 WHERE customerid = $customer_id";
				 
			 $update_result = mysqli_query($conn, $update_query);
			 
			 if(!$update_result){
				 echo "Update failed! " . mysqli_error($conn);
				 exit;
			 }
			 
			 return $customer_id;
		 } else {
			 // Customer doesn't exist - create new
			 return setCustomerId($customername, $address, $city, $zip_code, $country);
		 }
	}
	function insertIntoOrder($customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_zip_code, $ship_country){
		$conn = db_connect();
		$query = "INSERT INTO orders VALUES ('', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_zip_code . "', '" . $ship_country . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
	}
		
	function setCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		//check if input fields are empty
	
		$query = "INSERT INTO customers VALUES ('', '" . $name . "', '" . $address . "', '" . $city . "', '" . $zip_code . "', '" . $country . "')";

		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "insert false !" . mysqli_error($conn);
			exit;
		}
		$customerid = mysqli_insert_id($conn);
		return $customerid;
	}

	function getPubName($conn, $pubid){
		$query = "SELECT publisher_name FROM publisher WHERE publisherid = '$pubid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Empty books ! Something wrong! check again";
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		return $row['publisher_name'];
	}

    //get all pub name from publisher table
    function getAllPub($conn){
        $query = "SELECT publisherid, publisher_name FROM publisher ORDER BY publisher_name ASC;
";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Can't retrieve data " . mysqli_error($conn);
            exit;
        }
        return $result;
    }

	function getAll($conn){
		$query = "SELECT * from books ";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getallpublisher($conn){
		$query = "SELECT * FROM publisher";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getcustomerorder($conn, $customerid){
		$query = "SELECT * FROM orders WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	//get customer id by name and phone
	function getcustomeridbyphone($conn, $name, $phone){
		$query = "SELECT customerid FROM customers WHERE name = '$name' AND phone = '$phone'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['customerid'];
	}

	function getpurchasebyorderid($conn, $orderid){
		$query = "SELECT * FROM order_items WHERE orderid = '$orderid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
	
	function getcustomerpurchaseorder($conn, $customerid) {
		$query = "SELECT o.*, oi.book_isbn, oi.item_price, oi.quantity, b.book_title, b.book_image 
				  FROM orders o 
				  LEFT JOIN order_items oi ON o.orderid = oi.orderid 
				  LEFT JOIN books b ON oi.book_isbn = b.book_isbn 
				  WHERE o.customerid = ? 
				  ORDER BY o.orderid DESC";
				  
		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_bind_param($stmt, "i", $customerid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		if(!$result) {
			throw new Exception("Failed to retrieve purchase history: " . mysqli_error($conn));
		}
		
		return $result;
	}

	function getLatestOrderId($conn, $customerid) {
		$query = "SELECT orderid FROM orders 
				  WHERE customerid = ? 
				  ORDER BY orderid DESC 
				  LIMIT 1";
				  
		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_bind_param($stmt, "i", $customerid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		if(!$result) {
			throw new Exception("Failed to retrieve order ID: " . mysqli_error($conn));
		}
		
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'] ?? null;
	}
?>