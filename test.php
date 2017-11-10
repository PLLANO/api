<?php
// Мы потдерживаем работу с следующими запросами: 
// POST /price = Создание записи 
// POST /price/42 = Ошибка
// GET /price = Список прайс-строк
// GET /price/42 = Данные конкретной прайс-строки
// PUT /price = Обновить данные прайс-строк
// PUT /price/42 = Обновить данные конкретной прайс-строки
// DELETE /price = Удалить все прайс-строки
// DELETE /price/42 = Удалить конкретную прайс-строку

// Для тех кто может отправлять только с POST и GET запросы мы дублируем тип запроса в параметре $query
// Если вы в массиве $getArray укажите $query = 'DELETE' и отправите данные в POST запросе $pllanoApi->post($action, $getArray, $uid); данные будут удалены.

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

// Устанавливаем настройки отправки сообщения администратору если API даст ошибку
$HTTP_HOST = $_SERVER['HTTP_HOST']; // Получаем хост
$to      = 'info@pllano.com';
$subject = 'PLLANO API на сайте - '.$HTTP_HOST;
$headers = 'From: admin@pllano.com' . "\r\n" .
    'Reply-To: admin@pllano.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
//	require 'vendor/autoload.php'; // Подключить через Composer — менеджер зависимостей для PHP
//	Альтернативные методы подключения библиотеки API
require_once __DIR__.'/PllanoApi.php';
//	require_once __DIR__.'/src/PllanoApi.php';
//	require_once(APPLICATION_PATH . '../vendor/pllano/api/src/PllanoApi.php');
	
$country = 'ua'; // Указываем страну. Влияет на формирование URL

$pllanoApi = new PllanoApi($country); // Подключаем PllanoApi

$action = 'price'; // Название модели к которой мы обращаемся
$metod = 'curl'; // get = file_get_contents или curl
$uid = null; // Уникальный индефикатор для обращения к конкретной записи (Например по конкретному заказу). Если пусто выводим список.

$public_key = 'test'; // Публичный ключ авторизации. Сгенерировать в настройках API каждого магазина. По умолчанию test для настройки API
$query = null; // Дублируем тип запроса. Имеет приоритет выше чем в самом запросе.
$order = null; // Сотрировка asc|desc По умолчанию asc
$sort = null; // Поле по которому сортируем. По умолчанию uid
$offset = null; // Смещение. Начать с указанной. По умолчанию 0
$limit = null; // Лимит вывода записей на страницу. По умолчанию 10

// Массив для GET запроса прайс-листов
$getArray = array(
	"public_key"	=> $public_key,
	"query"			=> $query,
	"order"			=> $order,
	"sort"			=> $sort,
	"offset"		=> $offset,
	"limit"			=> $limit
);

$records = array();
$records = $pllanoApi->get($getArray, $action, $metod, $uid); // Отправляем GET запрос. В ответ получаем PHP массив с данными.

print_r($records); // если PllanoApi не возвращает массив PHP - он вернет описание ошибки

if (isset($records['header']['code'])) {

if ($records['header']['code'] == '200') {
	$total = $records['total']; // Всего товаров
	$limit = $records['limit']; // Выведено
	$offset = $records['offset']; // Страница
	
$count = count($records['source']);
if ($count >= 1 && $count == $limit) {

	foreach($records['source'] as $item)
	{
		print_r($item['uid'].' - '.$item['name'].' - '.$item['price']);
		print_r('<br>');
	}
}
} else {
// Иначе отправляем письмо администратору если code не равняется 200
$message = 'PLLANO API - Ошибка - code не равняется 200';
mail($to, $subject, $message, $headers);
}

} else {
// Иначе отправляем письмо администратору если code неопределен
$message = 'PLLANO API - Ошибка - code неопределен';
mail($to, $subject, $message, $headers);
}
