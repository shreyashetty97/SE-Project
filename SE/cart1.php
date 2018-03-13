<?php
	session_start();
	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');
	// $proid=$_REQUEST['docid'];
	$emailid=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT * from cart where email='$emailid';");
	//echo $proid;
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-compatible" Content="IE-edge">
	<meta name="viewport" content="width=device-width"> 
	<title>Online Shopping</title>
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="css/mystyle.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
	<style>
	#cart {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
	}

	#cart td, #cart th {
		border: 2px solid #ddd;
		padding: 8px;
	}

	#cart tr {background-color: #f2f2f2;}

	#cart tr:hover {background-color: #ddd;}

	#cart th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
	</style>
</head>
<body>
	<table id='cart'>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<!--<th>Quantity</th>-->
			</tr>
			<?php
			if(mysqli_num_rows($result)>0)
			{
				while($row=mysqli_fetch_array($result))
				{
					$result1=mysqli_query($con,"SELECT * from products where productID=$row[1];");	
					if(mysqli_num_rows($result1)>0)
					{
						while($row1=mysqli_fetch_array($result1))
						{
			?>
			
			<tr>
			<td><img src="images/<?php echo $row1[4]; ?>" width="150" height="150"/></td></td>
			<td><?php echo $row1[1]; ?></td>
			<td><?php echo $row1[2]; ?></td>
			<td><?php echo $row[2]; ?></td>
			</tr>
			
			<?php
						}
					}
				}
			}
			else
			{
				echo "<script>alert('No items in cart!!!');";
				echo "location.href='home_login.php';</script>";
				exit;
			}
			?>

	</table>
</body>
</html>