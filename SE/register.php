<?php
	// Start the session
	session_start();
	
	if(isset($_POST['reg_user'])) {

	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');
	
	$uname = $_POST['username'];
	$telno = $_POST['telno'];
	$addr = $_POST['address'];
	$email = $_POST['email'];
	$pword = $_POST['password_1'];
	$pword2 = $_POST['password_2'];
	
	if($pword != $pword2) {
		echo "<script>alert('Passwords do not match')</script>";
	}
	else {
		$checkexist = mysqli_query($con,"SELECT email FROM customers WHERE Email = '$email'");
		if(mysqli_num_rows($checkexist)){
			echo "User already exists!!!<br>";
		}
		else {
			echo "You are now registered.";
			mysqli_query($con,"INSERT INTO customers VALUES('$uname', '$telno', '$addr', '$email', '$pword')" );
			echo "<script> location.href='login.php';</script>";
			exit;
		}
		
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
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
label
{
	padding:5px;
}
</style>
</head>

<body>
	<div class="ab" align="center">
	<form method="post" action="register.php">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" required>
		</div>
		<div class="input-group">
			<label>Tel No</label>
			<input type="tel" name="telno" id="pno" pattern="[1-9]{1}[0-9]{9}" title="Enter 10 digit mobile number" required>
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" id="psw" name="password_1" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Must contain at least one number and one lowercase letter, and at least 8 or more characters" required>
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2" required>
		</div>
			<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
	</div>
</body>
</html>