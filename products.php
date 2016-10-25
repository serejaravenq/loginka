<!Doctype html>
<html>
<?php
//include "products/routing.inc.php";
$path="upload/";
$db = new mysqli("localhost","root","");
   $db->select_db("vapeshop");
   
   if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $db->query("SELECT * FROM products");
	
	 
	while( $row = $result->fetch_assoc() ){
	
    
  echo "Имя: ".$row['name']."<br>
  	 Цена: ".$row['price'] ."<br>
  	 Фото:<br> <img style='max-height:225px' src=".$path.$row['thumbnail']."><br>
  	 <a href='products/".$row['id']."'>Подробнее о картинке:</a><hr>";

    
}


$db->close();
	
?>
</html>