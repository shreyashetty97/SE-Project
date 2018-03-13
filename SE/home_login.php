<?php
	session_start();
	if($_SESSION['logged_user']==FALSE)
	{
		echo "<script>alert('User needs to login!!');</script>";
		echo "<script> location.href='login.php';</script>";
		exit;
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<title>HOME</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-compatible" Content="IE-edge">
	<meta name="viewport" content="width=device-width"> 
	<title>Online Shopping</title>
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="css/mystyle.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
	<style>
	#products {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 90%;
	}

	#products td, #products th {
		border: 2px solid #ddd;
		padding: 8px;
	}

	#products tr {background-color: #f2f2f2;}

	#products tr:hover {background-color: #ddd;}

	#products th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
	</style>
</head>
<body>
	<!------ header ------>
	<div class="container-fluid top_bar">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<a href="@" class="social_icons"><i class="fa fa-facebook" style="font-size:20px; color:#fff;"></i></a>
					<a href="@" class="social_icons"><i class="fa fa-twitter" style="font-size:20px; color:#fff;"></i></a>
					<a href="@" class="social_icons"><i class="fa fa-github" style="font-size:20px; color:#fff;"></i></a>
					<a href="@" class="social_icons"><i class="fa fa-google-plus" style="font-size:20px; color:#fff;"></i></a>
				</div>
				<div>
				<?php echo $_SESSION['email'] ?>
				</div>
			</div>
		</div>
	</div>
	<!------ end of header ----->
	<!--------- logo and navigation--------->
	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<img src="images/logo.jpe" href = "home.php" style="width: 200px; height: 200px; padding-top:5px;"/>
			</div>
			<div class="col-sm-7 my_menu">	
			<nav class="navbar navbar-default">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			</div>
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="">Home</a></li>
					<!--<li><a href="">About Us</a></li>
					<li><a href="">Contact Us</a></li>-->
				</ul>
			</div>
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="nav navbar-nav pull-right">
					<li><a href="logout.php">Logout</a></li>
					<li><a href="cart.php">View Cart</a></li>
				</ul>
			</div>
			</nav>
		</div>
	</div>
	<!-------- end of logo and navigation--------->

    <!-------products available----------->
    <div class="container-fluid our_doctors">
        <div class="container">
            <h1 class="text-center">PRODUCTS</h1>
			<?php
				$con = mysqli_connect('localhost', 'root', '','ecommerce');
				mysqli_select_db($con,'ecommerce');
				$result=mysqli_query($con,"SELECT * from products"); ?>
				
				<table id='products'>
					<tr>
						<th>Image</th>
						<!--<th>Product ID</th>-->
						<th>Name</th>
						<th>Price</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Add to Cart</th>
					</tr>
					<?php
						if(isset($_POST['link_btn']))
						{
						$quant=$_POST['quantity'];
						}
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_array($result))
							{
								
					?>
					
						<tr>
							<td><img src="images/<?php echo $row[4]; ?>" width="150" height="150"/></td>
							<!--<td><?php echo $row[0]; ?></td>-->
							
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<form method="post" action="<?=$_SERVER['PHP_SELF'];?>" target="votar">
							<td><input type="text" id='q' name="quantity" value="1" 
								style="width:50px;text-align:center;"/></td>
							<input type="hidden" name="hidden_name" value="<?php echo $row[0]; ?>"/>
							<input type="hidden" id='qa' name="hidden_quanity" value="<?php echo $row[5]; ?>"/>
							<td>
								<?php echo "<input type='submit' name='link_btn' align='center' value='Add To Cart'>
								</input>"; ?>
							</td>
							</form>
						</tr>
						<?php
							}
						}
						?>
						<iframe name="votar" style="display:none;">
						<?php
							$con = mysqli_connect('localhost', 'root', '','ecommerce');
							mysqli_select_db($con,'ecommerce');
							if(isset($_POST['hidden_name']) ) {
								$proid=$_POST['hidden_name'];
								$quan=$_POST['quantity'];
								$quana = $_POST['hidden_quanity'];
								// if( $quan < $quana )
								// {	
									$emailid=$_SESSION['email'];
									$q1=mysqli_query($con,"SELECT email,productid FROM cart where email='$emailid' AND productid='$proid';");
									if(mysqli_num_rows($q1)>0)
									{
										mysqli_query($con,"UPDATE cart SET Quantity='$quan' WHERE email='$emailid' AND productid='$proid';");
									}
									else
									{
										mysqli_query($con,"INSERT INTO cart VALUES('$emailid','$proid','$quan');" );
									}
								// }
							}																		
						?>
						</iframe>
				</table>
        </div>
    </div>
    <!------end of products available------>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

















