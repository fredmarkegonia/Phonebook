<?php
	
require_once('inc/db_connect.php');
$usernameerr = $passworderr = '';
if(isset($_POST['submit_btn'])){
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
		$insert_account = mysqli_query($con, "INSERT INTO `user` (`id`, `username`, `password`) VALUES (NULL, '$username', md5('$password'))");
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
			<form classs="myform" action="" method="post">
				<label><b>Username</b></label><br>
				<input type="text" class="inputvalues"name="username" placeholder="Type your username" required/><br>
				<?php echo $usernameerr; ?><br>
				<label><b>Password</b></label><br>
				<input name="password" type="password" class="inputvalues" placeholder="Your Password" required/><br>
				<label><b>Confirm password</b></label><br>
				<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm your password" required/><br>
				<?php echo $passworderr; ?>
				<input name="submit_btn" input class="btn" type="submit" id="signup_btn" value="Sign Up"/><br>
				<a href="lagin.php"><input type="button" input class="btn" id="login_btn" value="login"/></a>
			</form>
				</div>
			</div>
		</div>
	</div>




</body>
    
 

</html>