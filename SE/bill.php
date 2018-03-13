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
	$emailid=$_SESSION['email'];
	
	$totamt = $_REQUEST['amt'];
	$no =1;	

	//echo $totamt;
?>
<html lang="en-US">
	<head>
	<title>BILL</title>
	<style>
		table {
			border-collapse: collapse;
			width: 80%;
			margin: auto;
			width: 60%;
			border: 3px solid #73AD21;
			padding: 10px;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
	</style>
	</head>
	
	<body>
		<table name='bill'>
		<caption>BILL</caption>
			<tr>
				<th>Sn No</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
			</tr>
			<?php
				$result = mysqli_query($con,"SELECT * from cart where email='$emailid';");	
				if(mysqli_num_rows($result)>0)
				{
					while($row=mysqli_fetch_array($result))
					{
						$result1=mysqli_query($con,"SELECT * from products where productID=$row[1];");	
						if(mysqli_num_rows($result1)>0)
						{
							while($row1=mysqli_fetch_array($result1))
							{
								$quanAvail = $row1['5'] - $row['2'];
								$proUpdation =  mysqli_query($con,"UPDATE products SET Quantity = '$quanAvail' WHERE ProductID = '$row[1]';");
								$orderUpdation = mysqli_query($con,"INSERT INTO ordertable VALUES('$emailid', '$row[1]', '$row[2]');" );
			?>
			<tr>

				<td><?php echo $no; $no+=1; ?></td>
				<td><?php echo $row1[1]?></td>				
				<td><?php echo $row[2] ?></td>				
				<td><?php echo $row1[2]?></td>				
			</tr>
			<?php
							}
						}
					}
				}
				
			$result1 = mysqli_query($con,"DELETE from cart where email='$emailid';");	

			?>
			<tr>
				<th colspan="3">Total Amt: </th>
				<td><?php echo $totamt	?></td>
			</tr>
		</table>
		<?php
				echo '<script language="javascript">';
				echo 'alert("Order Successful")';
				echo '</script>';
		?>
		<button align='center'><a href="home_login.php">Continue Shopping</a></button>
	</body>
</html>