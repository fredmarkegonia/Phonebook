<?php
	
require_once('inc/db_connect.php');
$usernameerr = $passworderr = '';
if(isset($_POST['r_btn'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
	$check_username = "select * from user where username = '$username'";
	$query = mysqli_query($con, $check_username);
	$count = mysqli_fetch_array($query);
	if($count >1){
		$usernameerr = "Username is already taken";
	}else{
		$username = $_POST['username'];
	}
	
	if($password != $cpassword){
		$passworderr = 'Password not match';
	}else{
		$password = $_POST['cpassword'];
	}
	
	if(empty($usernameerr) && empty($passworderr)){
		$insert_account = mysqli_query($con, "INSERT INTO `user` (`id`, `username`, `password`) VALUES (NULL, '$username', ('$password'))");
		if($insert_account){
			echo "<script>alert('Added');</script>";
		}
	}
	
}
?>


<html>
<head>
	<title>Phone Book</title>
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<div class="container text-center">
		<div class="row">
			<div class="header col-md-12">
				<a href="index.php"><h1>Phone Book</h1></a>
			</div>
		</div>
	</div>
     <div class="container">
		 <div class="row">
			<div class="col-4 offset-4">		
				<br>
				<div class="card">
					<img class="card-img-top" src="img/img1.jpeg" alt="Card image cap">
					<div class="card-body">
					<label for="validationCustom01">Username:</label>
					<input type="text" class="form-control" id="validationCustom02" placeholder="Username" value="" required>
					<label for="validationCustom01">Password:</label>
					<input type="text" class="form-control" id="validationCustom02" placeholder="Password" value="" required>
					<label for="validationCustom01">Confirm Password:</label>
					<input type="text" class="form-control" id="validationCustom02" placeholder="Cpassword" value="" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						Register</button>
					<a href="login.php"><button class="btn btn-lg btn-primary btn-block" type="submit">
						Login</button></a>
					<label class="checkbox pull-left">
					 </div>
				</div>
			</div>
		</div>
	</div>




</body>
    
 

</html>