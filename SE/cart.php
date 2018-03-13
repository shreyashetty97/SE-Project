<?php
	session_start();
	if($_SESSION['logged_user']==FALSE)
	{
		echo "<script>alert('User needs to login!!');</script>";
		echo "<script> location.href='login.php';</script>";
		exit;
	}
	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');
	// $proid=$_REQUEST['docid'];
	$emailid=$_SESSION['email'];
	//echo $proid;
	$totamt=0;
	$flag=0;
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>CART</title>
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
	<div align='center'>
		<table id='cart'>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Remove </th>
					<!--<th>Quantity</th>-->
				</tr>
				<?php
				$result = mysqli_query($con,"SELECT * from cart where email='$emailid';");
				if(mysqli_num_rows($result)>0)
				{
					while($row=mysqli_fetch_array($result))
					{
						$result1=mysqli_query($con,"SELECT * from products where productID='$row[1]';");	
						if(mysqli_num_rows($result1)>0)
						{
							while($row1=mysqli_fetch_array($result1))
							{											
								if($row1[5] >= $row[2])
								{
				?>
				
				<tr>
				<td><img src="images/<?php echo $row1[4]; ?>" width="150" height="150"/></td></td>
				<td><?php echo $row1[1]; ?></td>
				<td><?php echo $row1[2]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<form method="post" action="<?=$_SERVER['PHP_SELF'];?>" target="votar">
				<td>
					<input type="hidden" name="hidden_id" value="<?php echo $row[1]; ?>"/>
					<?php echo "<input type='submit' name='link_btn' align='center' value='Remove'>
					</input></a>"; ?>
				</td>
				</form>
				<iframe name="votar" style="display:none;">
						<?php
							if(isset($_POST['hidden_id']) ) {
								$proid=$_POST['hidden_id'];
									$emailid=$_SESSION['email'];
									$q1=mysqli_query($con,"DELETE FROM cart where email='$emailid' AND productid='$proid';");
									// if (mysqli_query($con, $q1)) {
										// echo "<script>alert(' " , $proid , " removed from cart!');</script>";
										// $flag=1;
									// } else {
										// echo "Error deleting record: " . mysqli_error($conn);
									// }
								// }
							}																		
						?>
				</iframe>
				<?php $totamt+=($row1[2]*$row[2]); ?>
				</tr>
				
				<?php
								}
								else
								{
									mysqli_query($con,"DELETE FROM cart WHERE email='$emailid' AND productID='$row[1]';");
									echo "<script>alert(' " , $row1[1] , " is not available or out of stock');</script>";
								}
							}
						}
					}
				?>
							<tr>
							<th colspan="4">Total Amt: </th>	
							<td><?php echo $totamt; ?></td>
							</tr>
				<?php
				}
				else
				{
					echo "<script>alert('No items in cart!!!');";
					echo "location.href='home_login.php';</script>";
					exit;
				}
				?>
		</table>
	</div>
	
	<br><br>
	
	<div align='center'>
			<button><a href='home_login.php'>Go Back</a></button>
			<?php echo "<button><a href='bill.php?amt=$totamt'>Confirm Order</a></button>";?>
	</div>
</body>
</html>