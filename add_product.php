<?php
	$name= $_POST["name"];
	$price=$_POST["price"];
	
	// Смотрим что к нам пришло с формы
// и проверяем
	if(empty($name) || empty($price)){
		echo "Имя или цена не указаны";
		exit;
	}

   if(!empty($_FILES["filename"]["name"])){
   if($_FILES["filename"]["size"] > 1024*2*1024)
   {
     echo ("Размер файла превышает два мегабайта");
     exit;
   }
}else{
	echo "Файл пуст";
	exit;
}

$path="upload/";

	if(!is_dir($path)){
		mkdir($path, 0777,true);
		 if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
   	
   	
     move_uploaded_file($_FILES["filename"]["tmp_name"], $path.$_FILES["filename"]["name"]);
     echo "Файл успешно загружен";
   }else{
   	echo "Ошибка загрузки файла";
   }
	}elseif(is_dir($path)){
		 if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
   	
   	
     move_uploaded_file($_FILES["filename"]["tmp_name"], $path.$_FILES["filename"]["name"]);
     echo "Файл успешно загружен";
   }else{
   	echo "Ошибка загрузки файла";
   }
	}else{
		echo " не удалось создать директорию";
	}

   // Проверяем загружен ли файл
  
   
  //подключаемся к бд
   $db = new mysqli("localhost","root","");
   $db->select_db("vapeshop");
   //проверяем коннект
   if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
	$thumbnail = $db->real_escape_string($_FILES["filename"]["name"]);
	
	$sql=$db->query("INSERT INTO products(name,price,thumbnail) 
							VALUES('$name','$price','$thumbnail')");
	$result = $db->query("SELECT thumbnail FROM products WHERE thumbnail ='$thumbnail' ");
	$db->close();
	$row= $result->fetch_assoc();
	
?>
<!DOCTYPE html>

<html >
	<head></head>
<body>
	<div>
		<img src="<?php echo $path.$row["thumbnail"];?>">
	</div>
</body>
	</html>