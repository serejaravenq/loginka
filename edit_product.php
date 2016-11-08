
<?php

//Проверяем что за id переда  через GET
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $path="upload/";
    //Создаем коннект к бд
    $db = new mysqli("localhost","root","");
    $db->select_db("vapeshop");
    //Проверяем коннект
        if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();

        }

    $result = $db->query("SELECT * FROM products where id = $id"); //отправляем запрос к бд , Ищем строку которая соответсвует моей переменной
    $row = $result->fetch_assoc();//Преобразовали в ассоц. массив. Его значения будем сравнивать со значениями с $_POST
        
        if (isset($_POST['name'])) {// проверяем что в POST['name']
            $name = $_POST['name'];

            if($name != $row['name'] && $name !=''){// если $name= $row['name'], то сюда мы не попадем
                $result = $db->query("UPDATE products SET 
                                
                                name = '$name'
                                WHERE id = '$id'
                                ");
        $result = $db->query("SELECT * FROM products where id = '$id'"); //внутри конструкции отправляем запрос к бд 
        $row = $result->fetch_assoc();

            }
        
        }

        if (isset($_POST['price'])){// проверяем что в POST['price']
            $price = $_POST['price'];

            if($price !=$row['price'] && $price !=''){// если $price= $row['price'], то сюда мы не попадем
                $result = $db->query("UPDATE products SET

                                price = '$price'
                                WHERE id = '$id'
                                ");
        $result = $db->query("SELECT * FROM products where id = '$id'"); //внутри конструкции отправляем запрос к бд 
        $row = $result->fetch_assoc(); 
                
            }
        
        } 
  /////////////////////////////////////////////      
        if(!empty($_FILES['filename']['name'])){ //Проверяем что передает нам input type=file

                if($_FILES["filename"]["size"] > 1024*2*1024) {
                        print "Размер файла превышает два мегабайта";
                        exit;
                }

        $tmp_name = $_FILES['filename']['tmp_name'];
        $getimagesize = getimagesize($tmp_name);// Проверяем его на тип файла, засовываем в getimagesize
        
        $mime_type= $getimagesize['mime'];// Достаем нужный нам MIME-тип
        $wh_mime = array('image/gif',
                        'image/jpeg',
                        'image/png');//Создаем МАссив

        if(!in_array($mime_type,$wh_mime)) { //Сравниваем внутри массива wh_mime значение mime_type
                print " Неверный формат изображения! Доступные для загрузки форматы: *.gif *.jpg *.png";

        }else{

        if($mime_type == 'image/gif') {
                $expansion='.gif';

        }elseif($mime_type=='image/jpeg') {
                $expansion ='.jpg';

        }elseif($mime_type=='image/png') {
                $expansion='.png';

        }else{
                $expansion ='';

             }
        }

        if($expansion !='') {
        $upload_patch =$path.$_FILES['filename']['name'];

        }
        // Проверяем загружен ли файл
        if(is_uploaded_file($tmp_name)) {
            move_uploaded_file($tmp_name, $upload_patch);//перемещам файл в место, куда указываем переменной $upload_patch

        }
         $thumbnail = $db->real_escape_string($_FILES["filename"]["name"]);//Экранируем запрос
        }
////////////////////////////////////////
       
        if(isset($thumbnail)){
            
                if($thumbnail != $row['thumbnail'] && $thumbnail !=''){
                    $result = $db->query("UPDATE products SET 
                                thumbnail = '$thumbnail'
                                WHERE id = '$id'");// отправляем запрос на обновление к бд
                $result = $db->query("SELECT * FROM products where id = '$id'"); //отправляем запрос к бд , Ищем строку которая соответсвует моей переменной
                $row = $result->fetch_assoc();   

                    }
    }

    $db->close();// закрыли базу//  

}// Вышли из условия isset($_GET('id'))


    
    
    



?>
<html>
<body>
        <form  method="post" enctype="multipart/form-data">
        Имя:<input type="text" name="name"   size="5" value = "<?php echo $row['name'];?>"><br>
        Цена:<input type="text" name="price" size="3"  value = "<?php echo $row['price'];?>"><br>
        <div>Thumbnail: <input type="file"  name="filename" accept="image/*" ><br>    <img style='max-height:225px; margin: 5px 0;' src="<?php echo $path.$row['thumbnail']?>"  ><!-- Картинка берется из папки upload--></div>
        <input type="submit" value="Сохранить изменения">  
        </form>
        <hr>
</body>
</html



