<?php
require_once('inc/db_connect.php');
$id = $_GET['id'];
$show_user = "SELECT * FROM contacts WHERE id = $id";
$result = mysqli_query($con,$show_user)->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Phone Book</title>
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Header Area -->
	<div class="container text-center">
		<div class="row">
			<div class="header col-md-12">
				<a href="index.php"><h1>Phone Book</h1></a>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<div class="row">
			<div class="head_page col-md-12">
				<h2>Details of : <?php echo $result['name']; ?></h2>
			</div>
		</div>
	</div>

<?php if(!empty($result['imagename'])){ ?>

	<div class="container user-image">
		<div class="row">
			<img class="img-user-details" src="img/uploaded/<?php echo $result['imagename']; ?>">
		</div>
	</div>

<?php } ?>

	<div class="container">
		<div class="row">
			<form action="" method="post" class="col-md-12" enctype="multipart/form-data">
				<div class="sigle-input col-md-12">
					<label class="col-md-3">Name: </label>
					<input class="col-md-8" type="text" name="name" placeholder="Fred Mark" value="<?php echo $result['name']; ?>">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">Phone No: </label>
					<input class="col-md-8" type="text" name="phone" placeholder="10939" value="<?php echo $result['phone']; ?>">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">Email: </label>
					<input class="col-md-8" type="email" name="email" placeholder="derf@gmail.com" value="<?php echo $result['email']; ?>">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">Address: </label>
					<input class="col-md-8" type="text" name="address" placeholder="oroquieta" value="<?php echo $result['address']; ?>">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">Image: </label>
					<input type="file" name="image" class="col-md-8">
				</div>
				<div class="sigle-input col-md-12 text-center submit-data">
					<input class="col-md-2" type="submit" name="update" value="Update">
					<input class="col-md-2" type="submit" name="delete" value="Delete">
				</div>
			</form>
		</div>
	</div>


	<?php

	if (isset($_POST['delete'])) {
		$delete_query = "DELETE FROM contacts WHERE id = $id";
		if (mysqli_query($con,$delete_query)) {
			header('Location: index.php');
		} else {
			echo "<p class='text-center bg-danger'>Error</p>";
		}
	}
	

	// Update 

	if (isset($_POST['update'])) {
		$name  = $_POST['name'];
		$phone  = $_POST['phone'];
		$email  = $_POST['email'];
		$address  = $_POST['address'];
		$uploadDir = '/phonebook/img/uploaded/';
		
		$update_contact_query = "UPDATE contacts SET name = '$name', phone = '$phone' , email = '$email',address = '$address' WHERE id = $id";
		
		if (!empty($_FILES['image']['name'])) {
			$tempFile   = $_FILES['image']['tmp_name'];
    		$file_extention = explode('.', $_FILES['image']['name']);
    		$file_name_new = uniqid('',true). '.' .end($file_extention);
    		$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
    		$targetFile = $uploadDir . $file_name_new;
    		move_uploaded_file($tempFile, $targetFile);
    		$update_contact_query = "UPDATE contacts SET name = '$name', phone = '$phone' , email = '$email', address = '$address' , imagename = '$file_name_new' WHERE id = $id";
		}
		
		if (!empty($name) || !empty($phone)) {
			if (mysqli_query($con,$update_contact_query)) {
				header('Location: index.php');
			} else {
				echo "<p class='text-center bg-danger'>Error</p>";
			}
		}
	}

	?>

	

	<!-- Footer Part -->
	<div class="container text-center "> <!--  fixed-bottom -->
		<dir class="row">
			<dir class="col-md-12 footer">
				<p class="col-md-12">
			</dir>
		</dir>
	</div>
	
	<div class="fixedicon">
        
    </div>
	

	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/scrolltop.js"></script>
	<script src="dist/bootstrap/bootstrap.min.js"></script>
</body>
</html>
