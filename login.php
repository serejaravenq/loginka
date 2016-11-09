<?php
// show all errors on
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

// input POST params
$email = $_POST["email"];
$pass = $_POST["password"];

// mysql connection
$db = new mysqli("localhost", "root", "");
$db->select_db("vapeshop");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$result = $db->query("SELECT * FROM admins WHERE email = '$email' && password = '$pass'");

$db->close();

$row = $result->fetch_assoc();

if ( $row ) {
	echo "Привет, " . $row["email"]."<br>
		<a href='new_product'>Добавить товар</a><br>
		<a href='products.php'>Перейти к списку товаров</a>";
	setcookie('session_id', md5($row["email"]), time()+3600);
} else {
	echo "не правильно введены данные";
}

?>