# PLLANO REST API

Документация по работе с PLLANO REST API

PLLANO REST API — это бесплатный инструментарий для интеграции [pllano.com](https://pllano.com/) в ваш продукт.

Вы можете ипользовать популярный PHP HTTP client [Guzzle](https://github.com/guzzle/guzzle) - [Документация](http://docs.guzzlephp.org/en/stable/)

Вы можете ипользовать наш PHP HTTP client [PLLANO PHP HTTP client](src/Api.php)

<a name="general"></a>

### Мы потдерживаем работу с следующими запросами:

`POST /price` Создание записи 

`POST /price/42` Ошибка

`GET /price` Список прайс-строк

`GET /price/42` Данные конкретной прайс-строки

`PUT /price` Обновить данные прайс-строк

`PUT /price/42` Обновить данные конкретной прайс-строки

`DELETE /price` Удалить все прайс-строки

`DELETE /price/42` Удалить конкретную прайс-строку

Для тех кто может отправлять только с `POST` и `GET` запросы мы дублируем тип запроса в параметре `query`

### Ресурсы PLLANO REST API

`https://{country}.pllano.com/api/v1/{format}/{model}/{uid}`

`{country}` - страна по умолчанию ua

`{format}` - формат json или xlm

`{model}` - модель к которой обращаемся. Например price или search. [Список всех ресурсов PLLANO REST API](docs/query.md)

`{uid}` - уникальный индефикатор записи

### GET запрос к PLLANO REST API

`?public_key={public_key}&order={order}&sort={sort}&offset={offset}&limit={limit}`

`{public_key}` - Ваш ключ PLLANO REST API

`{limit}` - Записей на страницу. По умолчанию 10

`{offset}` - Страница. По умолчанию 0

`{order}` - Тип сортировки. По умолчанию asc

`{sort}` - Поле сортировки. По умолчанию uid

[Список всех параметров запроса](docs/query.md)

### PLLANO REST API - Всегда возвращает код 200 даже при логических ошибках !

`HTTP/1.1 200 OK`

`Content-Type: application/json`

### В теле ответа API вернет код ошибки, статус и описание ошибки.

[Коды ошибок HTTP PLLANO REST API](errors.md)

### Документация по работе с PLLANO REST API
* [Список всех ресурсов PLLANO REST API](docs/query.md)
	* [Прайс-листы: Получить список товаров](docs/price.md)
	* [Прайс-листы: Конкретный товар](docs/price.md#item)
	* [Поиск: Получить список товаров](docs/search.md)
	* [Поиск: Конкретный товар](docs/search.md#item)

<a name="php"></a>
## [PLLANO PHP HTTP client](src/Api.phpp)

### Легкий старт

Скачайте файлы [test.php](test.php) и [src/Api.php](src/Api.php) положите их в корень вашего сайта.

Запуск: `http://example.com/test.php`

PLLANO REST API PHP обратится по адресу:

[https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10](https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10)

В ответ получит массив json конвертирует его в массив PHP

<a name="composer"></a>
-------
 **Установка PLLANO PHP HTTP client с помощью Composer

### Требования

PHP >= 5.3*

```
$ composer require pllano/api
```

composer.json

``` json
"require": {
	"pllano/api": "*"
}
```
<a name="test"></a>
### Пример использования

``` php
// Устанавливаем настройки отправки сообщения администратору если API даст ошибку
// Укажите свои данные
$HTTP_HOST = $_SERVER['HTTP_HOST']; // Получаем хост
$to      = 'info@pllano.com'; // Кто отправляет
$subject = 'Информация от PLLANO REST API на сайте - '.$HTTP_HOST;
$headers = 'From: admin@pllano.com' . "\r\n" .
    'Reply-To: admin@pllano.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
//	require 'vendor/autoload.php'; // Подключить через Composer — менеджер зависимостей для PHP
//	Альтернативные методы подключения библиотеки API
require_once __DIR__.'/Api.php';
//	require_once __DIR__.'/src/Pllano/Api.php';
//	require_once(APPLICATION_PATH . '../vendor/pllano/api/src/Pllano/Api.php');
	
$country = 'ua'; // Указываем страну. Влияет на формирование URL
$pllanoApi = new Pllano\Api($country); // Подключаем PllanoApi
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
	"query"		=> $query,
	"order"		=> $order,
	"sort"		=> $sort,
	"offset"	=> $offset,
	"limit"		=> $limit
);
$records = array();
// Отправляем GET запрос. В ответ получаем PHP массив с данными.
$records = $pllanoApi->get($getArray, $action, $metod, $uid); 
print_r($records); // если PllanoApi не возвращает массив PHP - он вернет описание ошибки
print_r('<br>');
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
//	Иначе отправляем письмо администратору если ["header"]["code"] не равняется 200
$message = 'PLLANO REST API - Ошибка - ["header"]["code"] не равняется 200 - на сайте: '.$HTTP_HOST;
mail($to, $subject, $message, $headers);
}
} else {
//	Иначе отправляем письмо администратору если ["header"]["code"] неопределен
$message = 'PLLANO REST API - Ошибка - ["header"]["code"] неопределен - на сайте: '.$HTTP_HOST;
mail($to, $subject, $message, $headers);
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
