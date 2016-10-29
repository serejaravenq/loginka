
<?php
$path="upload/";
//Создаем коннект к бд
$db = new mysqli("localhost","root","");
$db->select_db("vapeshop");
//Проверяем коннект
   	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
//Проверяем что за id переда  через GET
	if(isset($_GET['id'])){
		$id = $_GET['id'];//передаем переданную id в переменную $id
		$result = $db->query("SELECT * FROM products where id = $id"); //отправляем запрос к бд , Ищем строку которая соответсвует моей переменной
		$row = $result->fetch_assoc(); //Полученный ответ перемещаем в ассоц. массив
    	echo    "Номер:".$row['id']."<br>
             	имя:".$row['name']."<br>
             	Цена:".$row['price']."рублей<br>
             	Фото :<br> <img style='max-height:225px' src=".$path.$row['thumbnail']."><br>
             	<a href=?red_id=".$row['id'].">Редактировать</a>";// Выводим эхом  нужные мне значения из массива.
				
	}
	
	
    if (isset($_GET['red_id'])) { //Проверяем , если передано значение red_id
        $id = $_GET['red_id']; 
        
        ?>
<html>
<body>
		<form  method="post"><!--В теле условия отрисовываю форму HTML , саму конструкцию if я закрою в самом конце, стр(62)-->
    	Имя:<input type="text" name="name" size="6""><br>
    	Цена:<input type="text" name="price" size="3""> руб.<br>
    	Thumbnail: <input type="file" name="thumbnail" accept="image/*" ><br><!-- Картинка берется из папки upload-->
    	<input type="submit" value="OK">  
		</form>
		<hr>
</body>
</html

<?php
    		if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['thumbnail'])) { //Если новое имя и цена и картинка переданы, то обновляем и имя и цену и картинку
					$name= $_POST['name'];
					$price= $_POST['price'];
					$thumbnail = $_POST['thumbnail'];            
            		$result = $db->query("UPDATE products SET 
                    			name = '$name',
                    			price = '$price',
                    			thumbnail = '$thumbnail'
                    			WHERE id = '$id'");// отправляем запрос на обновление к бд
       		}
       	 

    $result = $db->query("SELECT * FROM products where id = $id");//и повторно делаем запрос к бд на запись которорая соответсвует $id
	$row = $result->fetch_assoc(); 
    echo   "Номер:".$row['id']."<br>
             имя:".$row['name']."<br>
             Цена:".$row['price']." рублей<br>
             Фото:<br> <img style='max-height:225px' src=".$path.$row['thumbnail']."><br>
             <a href='products.php'> Назад </a>";// выводим значения из массива
             				
    }//закрыли конструкцию , которая при срабатывании отрисовывала HTML форму

$db->close();// закрыли базу

?>



