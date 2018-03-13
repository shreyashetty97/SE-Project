<?php
	session_start();
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
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
				</ul>
			</div>
			</nav>
		</div>
	</div>
	<!-------- end of logo and navigation--------->
 	<!-------description----------->
<!-- <div class="container">
		<div class="row">
			<div class="col-sm-9 bbokadoc">
				<h1>Online Shopping</h1>
				<p>The English Wikipedia is the English-language edition of the free online encyclopedia Wikipedia. Founded on 15 January 2001, it is the first edition of Wikipedia and, as of November 2017, has the most articles of any of the editions.[2] As of February 2018, 12% of articles in all Wikipedias belong to the English-language edition. This share has gradually declined from more than 50 percent in 2003, due to the growth of Wikipedias in other languages.[3] There are 5,577,124 articles on the site (live count).</p>
				<p>In October 2015, the combined text of the English Wikipedia's articles totalled 11.5 gigabytes when compressed.[5] On 1 November 2015, the English Wikipedia announced it had reached 5,000,000 articles[6] and ran a special logo to reflect the milestone.</p>
				<p>The Simple English Wikipedia is a variation in which most of the articles use only basic English vocabulary. There is also the Old English (Ænglisc/Anglo-Saxon) Wikipedia (angwiki). Community-produced news publications include The Signpost</p>
                </br>
                </br>
			</div>
			<div class="col-sm-3 text-right">
                <img src="images/sidepic.jpg" alt="" class="img-responsive sidepicc"/>
			</div>
		</div>
	</div>
	<!-----end of description----------->
    <!-------doctors available----------->
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
						<th>Product ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Description</th>
						<th>Add to Cart</th>
					</tr>
					<?php
						if(mysqli_num_rows($result)>0)
						{
							while($row=mysqli_fetch_array($result))
							{
					?>
						<tr>
							<td><img src="images/<?php echo $row[4]; ?>" width="150" height="150"/></td>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<td><button id='add'type="button" onclick="func()">Add to Cart</button></td>
							<script>
								function func() {
									 alert("Login to Add to cart");
								}
							</script>
						</tr>
						<?php
							}
						}
						?>
				</table>
        </div>
    </div>
    <!------end of doctors available------>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

















