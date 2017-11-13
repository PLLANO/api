<?php
//	require '../vendor/autoload.php'; // Подключить Composer
require_once __DIR__.'/Api.php';

$action = 'price'; // Название модели к которой мы обращаемся
$metod = 'curl'; // get = file_get_contents или curl
$id = null; // Уникальный индефикатор item. Если null выводим список.

$public_key = 'test'; // Публичный ключ авторизации. По умолчанию test для настройки API
$query = null; // Дублируем тип запроса. Имеет приоритет выше чем в самом запросе.
$order = null; // Сотрировка asc|desc По умолчанию asc
$sort = null; // Поле по которому сортируем. По умолчанию id
$offset = null; // Смещение. Начать с указанной страницы. По умолчанию 0
$limit = null; // Лимит вывода записей на страницу. По умолчанию 10

//Массив для GET запроса
$getArray = array(
	"public_key"	=> $public_key,
	"query"		=> $query,
	"order"		=> $order,
	"sort"		=> $sort,
	"offset"	=> $offset,
	"limit"		=> $limit
);

$api = new Pllano\Api('ua');
$records = $api->get($getArray, $action, $metod, $id);

if (isset($records['header']['code'])) {
if ($records['header']['code'] == '200') {
	$count = count($records['price']['items']);
	if ($count >= 1) {
		foreach($records['price']['items'] as $item)
		{
			print_r($item['item']['id']);
		}
	}
}
} 
