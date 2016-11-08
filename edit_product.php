
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
        $id = $_GET['id'];
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
         
		
		$result = $db->query("SELECT * FROM products where id = $id"); //отправляем запрос к бд , Ищем строку которая соответсвует моей переменной
		$row = $result->fetch_assoc();
        //Полученный ответ перемещаем в ассоц. массив
    	
	}
	
	
    

$db->close();// закрыли базу//

?>
<html>
<body>
        <form  method="post">
        Имя:<input type="text" name="name" size="6" value="<?php echo $row['name']?>"><br>
        Цена:<input type="text" name="price" size="3" value="<?php echo $row['price']?>"> руб.<br>
        <div>Thumbnail: <input type="file" class="agent" name="thumbnail" accept="image/*" ><br>    <img style='max-height:225px; margin: 5px 0;' src="<?php echo $path.$row['thumbnail']?>" class="disguise" ><!-- Картинка берется из папки upload--></div>
        <input type="submit" value="Сохранить изменения">  
        </form>
        <hr>
</body>
</html


