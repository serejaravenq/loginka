<?php
$title = 'Супер-мега сайт';
$header = "Добро пожаловать на наш сайт!";
$id = isset($_GET['id']) ? strtolower($_GET['id']) : 'inc/index.inc.php';


// Инициализация заголовков страницы
switch($id){
	case 'contact': 
		$title = 'Контакты';
		$header = 'Обратная связь';
		break;
	case 'about': 
		$title = 'О нас';
		$header = 'О нашем сайте';
		break;
	case 'info': 
		$title = 'Информация';
		$header = 'Информация';
		break;
	case 'log': 
		$title = 'Журнал посещений';
		$header = 'Журнал посещений';
		break;
	case 'gbook': 
		$title = 'Гостевая книга';
		$header = 'Наша гостевая книга';
		break;		

}