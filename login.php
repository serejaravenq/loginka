<?php
$user = $_POST["username"];
$pass = $_POST["password"];
//var_dump($user);
$db = new mysqli("localhost", "root", "");
$db->select_db("wapeshop");
$r = $db->query("SELECT * FROM admins ");
//var_dump($r);
$db->close();
 $row = $r->fetch_assoc() ;
//var_dump($row);
//echo $row['email'];
if(($row['email'] == $user) && ($row['Password'] == $pass)){
	echo "Вы авторизовались";
	 setcookie('username', $user, time()+3600);
}else{
	echo "не правильно введены данные";
}


?>