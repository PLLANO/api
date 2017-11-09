# PLLANO REST API

Библиотека и документация по работе с PLLANO REST API

PLLANO REST API — это бесплатный инструментарий для интеграции [PLLANO](https://ua.pllano.com/) в ваш продукт.

<a name="general"></a>
### Прайс-листы интернет-магазинов

* [Список товаров](docs/price.md)
* [Просмотр конкретного товара](docs/price.md#item)


<a name="composer"></a>
### Требовани
-------
 **PHP >= 5.3*

Установка библиотеки PllanoApi
-------

Установка `PllanoApi` с помощью Composer.

```
$ composer require pllano/api
```

установка с помощью composer.json

```
"require": {
	"pllano/api": "v1.*"
}
```

## Пример работы с библиотекой PllanoApi PHP
-------

Save the above code fragment as `test.php` in your Web root folder.

``` php
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
	
$query = 'GET'; // Дублируем тип запроса. Имеет приоритет выше чем в самом запросе.
$order = ''; // Сотрировка asc|desc По умолчанию asc
$sort = ''; // Поле по которому сортируем. По умолчанию uid
$offset = ''; // Смещение. Начать с указанной. По умолчанию 0
$limit = ''; // Лимит вывода записей на страницу. По умолчанию 10
	
$public_key = 'test'; // Публичный ключ авторизации. Сгенерировать в настройках API каждого магазина. По умолчанию test для настройки API
$action = 'price'; // Название модели к которой мы обращаемся
$uid = ''; // Уникальный индефикатор для обращения к конкретной записи (Например по конкретному заказу). Если пусто выводим список.

// Массив для GET запроса прайс-листов
$getArray = array(
	"public_key"	=> $public_key,
	"query"		=> $query,
	"order"		=> $order,
	"sort"		=> $sort,
	"offset"	=> $offset,
	"limit"		=> $limit
);

$records = array();

require 'vendor/autoload.php'; // Подключить через Composer — менеджер зависимостей для PHP
//	Альтернативные методы подключения библиотеки API
//	require_once '/vendor/pllano/api/src/PllanoApi.php';
//	require_once __DIR__.'/src/PllanoApi.php';
//	require_once(APPLICATION_PATH . '../vendor/pllano/api/src/PllanoApi.php');
	
$country = 'ua'; // Указываем страну. Влияет на формирование URL
$pllanoApi = new PllanoApi($country); // Подключаем класс
	
$records = $pllanoApi->get($action, $getArray, $uid); // Отправляем GET запрос. В ответ получаем массив с данными.

// Библиотека обратится по адресу и получит в ответ массив json конвертирует его в массив PHP
// https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10
	
$count = count($records); // Считаем результат и если получили больше 1 читаем массив
	
if ($count >= 1) {
	foreach($records as $item)
	{
		print_r($item);
	}
}
```

<a name="feedback"></a>
## Поддержка, обратная связь, новости

Общайтесь с нами через почту api@pllano.com

Если вы нашли баг в работе PLLANO REST API загляните в
[issues](https://github.com/pllano/api/issues), возможно, про него мы уже знаем и
чиним. Если нет, лучше всего сообщить о нём там. Там же вы можете оставлять свои
пожелания и предложения.

За новостями вы можете следить по
[коммитам](https://github.com/pllano/api/commits/master) в этом репозитории.
[RSS](https://github.com/pllano/api/commits/master.atom).

Лицензия на библиотеку PLLANO REST API PHP
-------

The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.
