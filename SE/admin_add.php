<?php
	// Start the session
	session_start();
	if($_SESSION['logged_admin']==FALSE)
	{
		echo "<script>alert('Admin needs to login!!');</script>";
		echo "<script> location.href='admin_login.php';</script>";
		exit;
	}
	
	if(isset($_POST['insert_post'])) {

	$con = mysqli_connect('localhost', 'root', '','ecommerce');
	mysqli_select_db($con,'ecommerce');
	
	$proid = mysqli_real_escape_string($con,$_POST['Product_id']);
	$title = mysqli_real_escape_string($con,$_POST['Product_title']);
	$img = mysqli_real_escape_string($con,$_POST['Product_image']);
	$price = mysqli_real_escape_string($con,$_POST['Product_price']);
	$desc = mysqli_real_escape_string($con,$_POST['Product_desc']);
	$quan = mysqli_real_escape_string($con,$_POST['Quantity']);
	// echo $proid, $title, $img, $price, $desc;
	
		$checkexist = mysqli_query($con,"SELECT ProductID FROM products WHERE ProductID = '$proid'");
		if(mysqli_num_rows($checkexist)){
			echo "<script>alert('Product already exists!!!');</script>";
		}
		else {
			$query = "INSERT INTO products VALUES ('$proid', '$title', '$price', '$desc', '$img', '$quan');";
			
			if(!mysqli_query($con,$query)){
				die("DAMMIT");
			}
			else{ 
				echo '<script language="javascript">';
				echo 'alert("Successfully added to database")';
				echo '</script>';
			}
			
			 echo "<script> location.href='admin_home.php';</script>";
			 exit;
		}
		mysqli_close($con);
	}
?>
<!DOCTYPE>

<html>

	<head>
		<title> Insert Product</title>
		
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
		
	<body bgcolor="skyblue">
	
		<form action="admin_add.php" method="post">
			
			<table align="center" width="795" border="2" bgcolor="#187eae">
				
				<tr align="center">
				
					<td colspan="7">
					<h2> Insert New Product Here</h2>
					</td>
					
				</tr>

				<tr>
				
					<td align="right"> <b> Product ID: </b> </td>
					<td> <input type="number_format" name="Product_id" size="60" required /></td>
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Title: </b> </td>
					<td> <input type="text" name="Product_title" size="60" required /></td>
				</tr>
								
				<tr>
				
					<td align="right"> <b> Product Image : </b></td>
					<td> <input type="file" name="Product_image" required /></td>
				</tr>
				
				
				<tr>
				
					<td align="right"><b> Product Price: </b> </td>
					<td> <input type="text" name="Product_price" required /></td>
				</tr>
				
				<tr>
				
					<td align="right"><b>Quantity Available: </b> </td>
					<td> <input type="text" name="Quantity" required /></td>
				</tr>				
				
				<tr>
				
					<td align="right"><b> Product Description: </b> </td>
					<td> <textarea name="Product_desc" cols="20" rows="10" ></textarea></td>
				</tr>
				
				<tr align="center">				
					<td colspan="7"> <input type="submit" name="insert_post" value="Insert Product Now" /></td>
				</tr>
			</table>
		</form>
		<button><a href='admin_home.php'>HOME</a></button>
	</body>
	
</html>