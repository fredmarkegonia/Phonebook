<!DOCTYPE html>
<html>
<head>
	<title>Phone Book</title>
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
				<h2>Add Contact</h2>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<form action="" method="post" class="col-md-12"  enctype="multipart/form-data">
				<div class="sigle-input col-md-12">
					<label class="col-md-3">NAME:</label>
					<input class="col-md-8" type="text" name="name" placeholder="">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">PHONE NUMBER:</label>
					<input class="col-md-8" type="text" name="phone" placeholder="">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">EMAIL: </label>
					<input class="col-md-8" type="email" name="email" placeholder="">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">ADDRESS: </label>
					<input class="col-md-8" type="text" name="address" placeholder="">
				</div>
				<div class="sigle-input col-md-12">
					<label class="col-md-3">IMAGE: </label>
					<input type="file" name="image" class="col-md-8">
				</div>
				<div class="sigle-input col-md-12 text-center submit-data">
					<input class="col-md-2" type="submit" name="submit" value="Save">
				</div>
			</form>
		</div>
	</div>
	
<?php
require_once('inc/db_connect.php');

if (isset($_POST['submit'])) {
	$name  = $_POST['name'];
	$phone  = $_POST['phone'];
	$email  = $_POST['email'];
	$address  = $_POST['address'];
	$uploadDir = '/phonebook/img/uploaded/';

	$add_contact_query = "INSERT INTO contacts (name,phone,email,address,imagename) VALUES ('$name','$phone','$email','$address','')";

	if (!empty($_FILES['image']['name'])) {
		$tempFile   = $_FILES['image']['tmp_name'];
    	$file_extention = explode('.', $_FILES['image']['name']);
    	$file_name_new = uniqid('',true). '.' .end($file_extention);
    	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
    	$targetFile = $uploadDir . $file_name_new;
    	move_uploaded_file($tempFile, $targetFile);
    	$add_contact_query = "INSERT INTO contacts (name,phone,email,address,imagename) VALUES ('$name','$phone','$email','$address','$file_name_new')";
	}

	if (!empty($name) || !empty($phone)) {
		if (mysqli_query($con,$add_contact_query)) {
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


	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/scrolltop.js"></script>
	<script src="dist/bootstrap/bootstrap.min.js"></script>

	


</body>
</html>
