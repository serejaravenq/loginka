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


   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
   	$path="/wamp/tmp/";
     move_uploaded_file($_FILES["filename"]["tmp_name"], $path.$_FILES["filename"]["name"]);//указал конечную директорию точно такую же , что и временную т.е. /wamp/tmp/image.png ,спросить так можно?
     echo "Файл успешно загружен";

   } else {
      echo "Ошибка загрузки файла";
   }
   
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
	$db->close();
?>