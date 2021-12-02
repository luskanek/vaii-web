<?php
	include("config.php");

	function sanitize_input($data)  {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
			
		return $data;
	}	

	session_start();
		
	if ($connection) {
		$id = $_POST["input-new-id"];
		$author = $_SESSION["user_mail"];
		$title = $_POST["input-new-title"];
        $category = $_POST["select-new-category"];
        $description = $_POST["input-new-desc"];
        $price = $_POST["input-new-price"];
        $date = date("F Y");

		$dir = "C:/xampp/htdocs/uploads/";
		$file_names = array_filter($_FILES["files"]["name"]);

		$types = array("jpg", "jpeg", "png", "gif");
			
		if (isset($_POST["input-new-submit"]) && !empty($file_names)) {
			$query_images = "";
			
			foreach($_FILES["files"]["name"] as $key=>$val) {
				$file_name = basename($_FILES["files"]["name"][$key]);
				$file_path = $dir . $file_name;
				$file_type = pathinfo($file_path, PATHINFO_EXTENSION);

				if (in_array($file_type, $types)) {
					if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $file_path)) {
						$query_images .= $file_name . ";";
					}
				}
			}

			if (isset($title) && !empty($title)) {
				sanitize_input($title);
				
				if (isset($category) && $category != "none") {
					if (isset($description) && !empty($description)) {
						sanitize_input($description);
						
						if (isset($price)) {
							if (!empty($id)) {
								$query = "UPDATE items SET title='$title', category='$category', description='$description', price='$price', files='$query_images' WHERE id=$id";
											
								if (mysqli_query($connection, $query)) {			
									header("location: /index.php");	
								}
							}
							else {
								$query = "INSERT INTO items (author, title, category, description, price, date, files) VALUES ('$author', '$title', '$category', '$description', '$price', '$date', '$query_images')";
											
								if (mysqli_query($connection, $query)) {			
									header("location: /index.php");	
								}
							}
						}
					}
				}
			}
			mysqli_close($connection);
		}
	}
?>