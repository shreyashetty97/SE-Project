<?php
	session_start();
	if($_SESSION['logged_admin']==TRUE)
	{
		$_SESSION['logged_admin']=FALSE;
	}
	if(isset($_POST['log_user'])) {
	$email = $_POST['username'];
	$password = $_POST['password'];
	
	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');

	$result = mysqli_query($con,"SELECT * FROM customers WHERE Email='$email' AND Password='$password'");

	if(mysqli_num_rows($result)>0){
		$res = mysqli_fetch_array($result,MYSQLI_BOTH);
		$_SESSION['email'] = $res[3];
		$_SESSION['logged_user']=TRUE;
		//echo $_SESSION['email'];
		echo "<script> location.href='home_login.php'; </script>";
		//exit;
	}

	else{
		
		echo "<script> alert('Email not identified. Please Register!!');</script>";
		
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
<style>
body {
	background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('train.jpg');
	background-color: black;
	background-size : 100%;
	background-repeat: no-repeat;
    background-attachment: fixed;
    opacity: 0.8;
    filter:alpha(opacity=80);
	}
p{
	color : white;
}

.input-group{
	color : white;
	padding : 10px;
}
.ab
{
	border-style: solid;
	border-color: white;
    border-width: medium;
	border-radius : 8px;
	margin-left : 420px;
	margin-right : 420px;
	margin-top : 150px;
	padding : 10px;
	background-color : black;
	opacity: 0.8;
    filter:alpha(opacity=80);
}
.btn{
	background-color : white;
	color : black;
}
a:visited {
    color: red;
}

a:hover {
    color: hotpink;
}

a:active {
    color: blue;
}
.btn{
	background-color : white ;
	color : black;
	border: 2px solid #ffffff; 
	font-style : italic;

}
</style>
</head>
<body>
	<form method="post" action="login.php">
	<div class="ab" align="center">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="log_user">Login</button>
  	</div>
  	<p>
  		Didn't Register <a href="register.php">Sign Up</a>
		<br>
		Login as Admin <a href="admin_login.php">Admin Login</a>
  	</p>
	</div>
  </form>
</body>
</html>