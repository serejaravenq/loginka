<?php
	
	
	// Смотрим что к нам пришло с формы
// и проверяем
if(!empty($_POST['name']) && !empty($_POST['price'])) {
	$name= $_POST['name'];
	$price=$_POST['price'];
	$path="upload/";
}


if(empty($price) && empty($name)){
		print "Имя или
		цена не указаны";
		exit;
	}
	


	if(!empty($_FILES['filename']['name'])){

		if($_FILES["filename"]["size"] > 1024*2*1024){
    			print "Размер файла превышает два мегабайта";
    			exit;
   		}

	$tmp_name = $_FILES['filename']['tmp_name'];
	$getimagesize = getimagesize($tmp_name);
	$mime_type= $getimagesize['mime'];
	$wh_mime = array('image/gif',
					'image/jpeg',
					'image/png');

		if(!in_array($mime_type,$wh_mime)){
				print" Неверный формат изображения! Доступные для загрузки форматы: *.gif *.jpg *.png";

		}else{

				if($mime_type == 'image/gif'){
					$expansion='.gif';

				}elseif($mime_type=='image/jpeg'){
					$expansion ='.jpg';

				}elseif($mime_type=='image/png'){
					$expansion='.png';

				}else{
				$expansion ='';

				}
		}

		if($expansion !=''){
				$upload_patch =$path.$_FILES['filename']['name'];

		}
		// Проверяем загружен ли файл
		if(is_uploaded_file($tmp_name)){
		move_uploaded_file($tmp_name, $upload_patch);

		}

	}else{
		print "Файл пуст";
		exit;

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
	$result = $db->query("SELECT thumbnail FROM products WHERE thumbnail ='$thumbnail' ");
	$db->close();
	$row= $result->fetch_assoc();

	

?>
<!DOCTYPE html>

<html >
	<head></head>
<body>
	<div>
		<h1>Продукт успешно добавлен!</h1>
		<img src="<?php echo $path.$row["thumbnail"];?>"><br>
		<a href = "products.php">Перейти к списку товаров</a>
	</div>
</body>
	</html>
	
<?php 
			
	///////////////////// закрыли if(isset($_POST['name']) &&)

?>