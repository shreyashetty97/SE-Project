<?php
	session_start();
	if(isset($_POST['log_admin'])) {
	$email = $_POST['email1'];
	$password = $_POST['password1'];

	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');

	$result = mysqli_query($con,"SELECT * FROM admin WHERE email='$email' AND password='$password'");
	
	if(mysqli_num_rows($result)){
		$res = mysqli_fetch_array($result,MYSQLI_BOTH);
		$_SESSION['email'] = $res[0];
		echo $_SESSION['email'];
		$_SESSION['logged_admin']=TRUE;
		echo "<script> location.href='admin_home.php'; </script>";
		exit;
	}

	else{
		echo '<script language="javascript">';
		echo 'alert("ONLY ADMIN LOGIN")';
		echo '</script>';
		
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN LOGIN</title>
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
	<form method="post" action="admin_login.php">
	<div class="ab" align="center">
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email1">
  	</div>
	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password1">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="log_admin">Login</button>
  	</div>
  	<p>
		Login as User <a href="login.php">User Login</a>
  	</p>
	</div>
  </form>
</body>
</html>