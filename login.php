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

$result = $db->query("SELECT * FROM admins");

$db->close();

$row = $result->fetch_assoc();

if (($row['email'] == $email) && ($row['password'] == $pass)) {
	echo "Вы авторизовались \n";
	var_dump($row);
	 //setcookie('username', $user, time()+3600);
} else {
	echo "не правильно введены данные";
}
?>