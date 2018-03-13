<?php
	// Start the session
	session_start();
	if($_SESSION['logged_admin']==FALSE)
	{
		echo "<script>alert('Admin needs to login!!');</script>";
		echo "<script> location.href='admin_login.php';</script>";
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN HOME</title>
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
	a:link, a:visited {
    background-color: #000080;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
	margin-right:16px;
}
.ab
{
	border-style: solid;
	border-color: #ffffff;
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

a:hover, a:active {
    background-color: red;
}
	</style>
</head>
<body>
	<div class="ab" align="center">
	<a href = 'admin_update.php'><b>UPDATE</b></a>
	<a href = 'admin_add.php'><b>ADD</b></a>
	<br><br>
	<a href = 'home.php'><b>HOME PAGE</b></a>
	<a href = 'view_admin.php'><b>VIEW DATABASE</b></a>
	</div>
	<a href = 'logout.php'><b>LOGOUT</b></a>
</body>
</html>