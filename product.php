<?php
 if(isset($_GET['id'])){
 	$id = $_GET['id'];
 	$db = new mysqli("localhost","root","");
   $db->select_db("vapeshop");
   $path="upload/";
   if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $db->query("SELECT * FROM products WHERE id=$id");
	$row = $result->fetch_assoc();
	$db->close();
	
 }
 ?>
 <!DOCTYPE html>

<html >
	<head></head>
<body>
	<div>
	<p>Имя покупателя: <?php echo $row['name'];?></p>
	<p>Цена товара: <?php echo $row['price'];?></p>
	<hr>
		<img src="<?php echo $path.$row["thumbnail"];?>">
	}

	</div>
</body>
	</html>
	
