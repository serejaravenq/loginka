<?php

if ( isset ($_COOKIE["session_id"]) ) {
	$session_id = $_COOKIE["session_id"];

	$db = new mysqli("localhost", "root", "ilovephp1");
	$db->select_db("vapeshop");

	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$result = $db->query("SELECT * FROM admins WHERE auth_token ='$session_id' ");
	$db->close();

	$row = $result->fetch_assoc();

	if ( $row ) {
		echo "вы авторизованы , как " . $row["email"];
	} else {
		header('Location: form.html');
	}
} else {
	header('Location: form.html');
}
?>