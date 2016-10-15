<?php

if(isset ($_COOKIE["email"]))
$user = $_COOKIE["email"];
$session_id = md5($user);
var_dump($session_id);
$db = new mysqli("localhost", "root", "");
$db->select_db("vapeshop");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$result = $db->query("SELECT * FROM admins WHERE email = '$user' && auth_token ='$session_id' ");

$db->close();
$row = $result->fetch_assoc();
if($session_id = $row["auth_token"])
	echo "вы авторизованы , как" . $row["email"];
else
	header('Location: form.html');
?>