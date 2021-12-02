<?php
	include("config.php");

	session_start();
		
	if ($connection) {
		$id = $_POST["input-new-id"];
		$author = $_SESSION["user_id"];
		$title = $_POST["input-new-title"];
        $category = $_POST["select-new-category"];
        $description = $_POST["input-new-desc"];
        $price = $_POST["input-new-price"];

		$dir = "C:/xampp/htdocs/uploads/";
			
		if (isset($_POST["input-new-submit"])) {
			$query_images = "";
			
			foreach($_FILES["files"]["name"] as $key=>$val) {
				$file_name = basename($_FILES["files"]["name"][$key]);
				$file_path = $dir . $file_name;
				
				if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $file_path)) {
					$query_images .= $file_name . ";";
				}
			}

			if (!empty($id)) {
				$query = "UPDATE items SET title='$title', category='$category', description='$description', price='$price', files='$query_images' WHERE id=$id";
											
				if (mysqli_query($connection, $query)) {			
					header("location: /index.php");	
				}
			}
			else {
				$query = "INSERT INTO items (author, title, category, description, price, files) VALUES ('$author', '$title', '$category', '$description', '$price', '$query_images')";
											
				if (mysqli_query($connection, $query)) {			
					header("location: /index.php");	
				}
			}
		}
	}
?>