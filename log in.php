<?php
		require 'dbconfig/config.php';
		session_start();
		
		$username = $password = '';
		$err = '';
		if(isset($_POST['sign_in'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "select * from user where username = '$username' AND password = ('$password')";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
		echo $count ;
		if($count ==1 ) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['id'] = $row['id'];
			header('location: addnew.php');
		}else{
			$err = 'Invalid Username/Password';
		
		if($result){
      		echo "<script>alert('unknown Username! Please Register!');</script>";
    	}
			
		}
	}
	mysqli_close($con);	
		
		
?>

<html>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

     <div class="container">
		 <div class="row">
			<div class="col-sm-4 offset-4">		
					<br>
						<div class="card">
							<img class="card-img-top" src="img/img1.jpeg" alt="Card image cap">
							<div class="card-body">
						<label for="validationCustom01">Email:</label>
						<input type="text" class="form-control" id="validationCustom02" placeholder="Email" value="" required>
						<label for="validationCustom01">Password:</label>
						<input type="text" class="form-control" id="validationCustom02" placeholder="Password" value="" required>
						<input name="sign_in"  class="btn btn-block btn-info" type="submit" id="signin_btn" value="signin"/><br></a>
							Sign in</button>
						<label class="checkbox pull-left">
							<input type="checkbox" value="remember-me">
							Remember me
						</label>
						<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
						</form>
					</div>
					</br>
					<a href="register.html" class="text-center new-account">Create an account </a>
				</div>
			</div>
		</div>
	</div>




</body>
    
 

</html>