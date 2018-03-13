<?php
	session_start();
	if($_SESSION['logged_admin']==FALSE)
	{
		echo "<script>alert('Admin needs to login!!');</script>";
		echo "<script> location.href='admin_login.php';</script>";
		exit;
	}
	if(isset($_POST['update'])) {
		$id = $_POST['pid'];
		//echo $id;
		$con = mysqli_connect('localhost', 'root', '','ecommerce');
		mysqli_select_db($con,'ecommerce');

		$result = mysqli_query($con,"SELECT * FROM products WHERE ProductID='$id'");
		
		if(mysqli_num_rows($result)){
			$res = mysqli_fetch_array($result,MYSQLI_BOTH);
			$name = $res[1];
			$price = $res[2];
			$desc = $res[3];
			$img = $res[4];
			$quan = $res[5];
		}
		else
		{
			echo "<script>alert('Product Does Not exist');</script>";
			echo "<script> location.href='admin_home.php'; </script>";
			exit;
		}

	
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>UPDATE</title>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="skyblue">
	<form method="post" action="admin_update.php">
	Enter product ID:<br>
	<input type="text" name="pid">
	<br><br>
	<button type="submit" class="btn" name="update">Submit</button>
	</form>
	<br>
	<br>
	
	
	<?php
		if(isset($_POST['update'])) {
			echo "
				<form method='post' action='admin_update.php'>
				<table align='center' width='795' border='2' bgcolor='#187eae'>
							<tr align='center'>
								<td colspan='7'>
								<h2> Update Product</h2>
								</td>
							</tr>

							<tr>
							
								<td align='right'> <b> Product ID: </b> </td>
								<td> <input type='text' name='pid' size='25' value='$id' readonly></td>
							</tr>
							
							<tr>
							
								<td align='right'> <b> Product Title: </b> </td>
								<td>  <input type='text' name='Product_title' size='25' value='$name' required /></td>
							</tr>
											
							<tr>
							
								<td align='right'> <b> Product Image : </b></td>
								<td> <img src='images/$img'  width='150' height='150'></img><br>$img<br><input type='file' name='Product_image' value='images/$img' /></td>
							</tr>
							
							
							<tr>
							
								<td align='right'><b> Product Price: </b> </td>
								<td> <input type='text' name='Product_price' value='$price' required /></td>
							</tr>
							
							<tr>
							
								<td align='right'><b>Quantity Available: </b> </td>
								<td> <input type='text' name='Quantity' value='$quan' required /></td>
							</tr>

							<tr>
							
								<td align='right'><b> Product Description: </b> </td>
								<td> <textarea name='Product_desc' cols='20' rows='10'>$desc</textarea></td>
							</tr>
							
							<tr align='center'>				
								<td colspan='7'> <input type='submit' name='update_post' value='Update Product' /></td>
							</tr>
						</table>
					</form>";
		}
	?>
	<?php
		if(isset($_POST['update_post'])) {
			$con = mysqli_connect('localhost', 'root', '','ecommerce');
			mysqli_select_db($con,'ecommerce');
			
			$proid = $_POST['pid'];
			$title = $_POST['Product_title'];	
			$price = $_POST['Product_price'];
			$desc = $_POST['Product_desc'];
			$quan = $_POST['Quantity'];
			
			if ($_POST['Product_image'] == NULL){
				$sql = "SELECT Image FROM products WHERE ProductID = '$proid';";
				$imag = mysqli_query($con, $sql);
				// echo gettype($img);
				
				if (mysqli_num_rows($imag) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($imag)) {
						//echo "img: " . $row["Image"]. "<br>";
						$img = $row["Image"];
					}
				} 
				else {
					echo "<script>alert('No results');</script>";	
				}
				
			}
			else{
				$img = $_POST['Product_image'];
				//echo $img;
				// echo gettype($img);
			}
			
			$checkexist = mysqli_query($con,"SELECT ProductID FROM products WHERE ProductID = '$proid'");
			
			if(mysqli_num_rows($checkexist)){
					mysqli_query($con,"UPDATE products SET Name='$title', Price='$price', Description='$desc', Image='$img', Quantity='$quan'
						where ProductID='$proid'" );
					echo "<script>alert('Successfully Updated');</script>";				
			}
			else{
				echo "<script>alert('Product Does Not exist');</script>";
				echo "<script> location.href='admin_home.php'; </script>";
				exit;
				 
			}
		}
	?>
	<button><a href='admin_home.php'>HOME</a></button>
</body>
</html>
