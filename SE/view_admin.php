<?php
	// Start the session
	session_start();
	if($_SESSION['logged_admin']==FALSE)
	{
		echo "<script>alert('Admin needs to login!!');</script>";
		echo "<script> location.href='admin_login.php';</script>";
		exit;
	}

	$no=1;
	$con = mysqli_connect('localhost', 'root', '','ecommerce');
		mysqli_select_db($con,'ecommerce');
?>
<html lang="en-US">
	<head>
	<title>Database</title>
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
	<table>
	<caption>Products</caption>
		<tr>
			<th>Sr No.</th>
			<th>ProductID</th>
			<th>Product Name</th>
			<th>Quantity in Stock</th>
			<th>Price</th>
		</tr>
		<?php
			$result = mysqli_query($con,"SELECT * FROM products");
				if(mysqli_num_rows($result)>0)
				{
					while($row=mysqli_fetch_array($result))
					{				
		?>
		<tr>

			<td><?php echo $no; $no+=1; ?></td>
			<td><?php echo $row[0]?></td>				
			<td><?php echo $row[1] ?></td>				
			<td><?php echo $row[5]?></td>				
			<td><?php echo $row[2]?></td>				
		</tr>
		<?php
						}
					}
			$no = 1;
		?>
	</table>
	<br><br>
	<table>
	<caption>Customers</caption>
		<tr>
			<th>Sr No.</th>
			<th>Username</th>
			<th>Email ID</th>
			<th>Address</th>
		</tr>
		<?php
			$result1 = mysqli_query($con,"SELECT * FROM customers");
			if(mysqli_num_rows($result1)>0)
				{
					while($row=mysqli_fetch_array($result1))
					{
		?>
		<tr>
			<td><?php echo $no; $no+=1; ?></td>
			<td><?php echo $row[0]?></td>				
			<td><?php echo $row[3] ?></td>				
			<td><?php echo $row[2]?></td>								
		</tr>
		<?php
						}
					}
		?>
	</body>
</html>