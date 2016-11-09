<?php 
if(isset($_POST['id'])){
	//Создаем коннект к бд
$db = new mysqli("localhost","root","");
$db->select_db("vapeshop");
    //Проверяем коннект
	if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();

        }

$id = $db->real_escape_string($_GET['id']);
$result = $db->query("DELETE FROM

						products 
						WHERE id = '$id'");

$db->close();
header('Location: products.php');
}


if(isset($_GET['id'])){
	
    $id = htmlentities($_GET['id']);
    echo "<h2>Удалить товар?</h2>
        <form method='POST'>
        <input type='hidden' name='id' value='$id' />
        <input type='submit' value='Удалить'>
        </form>";
}



?>