# PLLANO REST API

Документация по работе с PLLANO REST API

PLLANO REST API — это бесплатный инструментарий для интеграции [pllano.com](https://pllano.com/) в ваш продукт.

Вы можете ипользовать популярный PHP HTTP client [Guzzle](https://github.com/guzzle/guzzle) - [Документация](http://docs.guzzlephp.org/en/stable/)

Вы можете ипользовать наш [PLLANO PHP HTTP client](src/Api.php)

<a name="general"></a>

### PLLANO REST API потдерживает запросы:

`POST /price` Создание записи 

`POST /price/42` Ошибка

`GET /price` Список прайс-строк

`GET /price/42` Данные конкретной прайс-строки

`PUT /price` Обновить данные прайс-строк

`PUT /price/42` Обновить данные конкретной прайс-строки

`DELETE /price` Удалить все прайс-строки

`DELETE /price/42` Удалить конкретную прайс-строку

Для тех кто может отправлять только с `POST` и `GET` запросы мы дублируем тип запроса в параметре `query`

### URL PLLANO REST API

`https://{country}.pllano.com/api/v1/{format}/{model}/{uid}`

`{country}` - страна по умолчанию ua

`{format}` - формат json или xlm

`{model}` - модель к которой обращаемся. Например price или search. [Список всех ресурсов PLLANO REST API](docs/query.md)

`{id}` - уникальный индефикатор

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

[Коды состояния HTTP](https://github.com/pllano/APIS-2018/tree/master/http-codes)

### Структура json
```json
{
    "headers": {
        "status": "200 OK",
        "code": "200",
        "message": "OK",
	"message_id": "https:\/\/github.com\/pllano\/APIS-2018\/tree\/master\/http-codes\/200.md"
    },
    "response": {
        "api": "v1.0",
        "total": "1000"
    },
    "request": {
        "query": "GET",
        "model": "price",
        "limit": "10",
        "offset": "0",
        "order": "DESC",
        "sort": "id",
        "state": "1",
        "type": "",
        "brand": "",
        "serie": "",
        "articul": "",
        "brand_id": "",
        "product_id": "",
        "search": ""
    },
    "body": {
        "items": [
            {
                "item": {
                    "id": "",
                    "product_id": "",
                    "parent_id": "",
                    "brand_id": "",
                    "price": "",
                    "oldprice": "",
                    "available": "",
                    "guarantee": "",
                    "ean": "",
                    "category": {
                        "id": "",
                        "parent_id": "",
                        "name": "",
                        "alias": ""
                    },
                    "supplier": {
                        "id": "",
                        "dropshipping": "",
                        "pay_online": ""
                    },
                    "seller": {
                        "id": "",
                        "name": ""
                    },
                    "delivery": {
                        "terms": ""
                    },
                    "currency": {
                        "currency_id": "UAH",
                        "short_sign": "₴",
                        "name": "грн.",
                    },
                    "name": "",
                    "type": "",
                    "brand": "",
                    "serie": "",
                    "articul": "",
                    "url": "",
                    "image": {
                        "1": "",
                        "2": ""
                    },
                    "description": "-",
                    "param": {
                        "Гарантия": "12 месяцев",
                        "Страна производитель": "Украина"
                    }
		}
            }
         ]
    }
}
```
### Структура xml

Структура xml очень сильно напоминает стандартные xml для выгрузки на торговые площадки, 
за исключением того что содержит свои блоки: header, response, request

```xml
<?xml version="1.0" encoding="utf-8"?>
<body>
    <date>2017-11-01 12:59:59</date>
    <header>
        <status>200 OK</status>
        <code>200</code>
        <message>OK</message>
    </header>
    <response>
        <platform>pllano.com</platform>
        <api>v1.0</api>
        <date>2017-11-13 04:51:18</date>
        <encoding>utf-8</encoding>
        <total>26</total>
    </response>
    <request>
        <query>GET</query>
        <model>price</model>
        <limit>10</limit>
        <offset>0</offset>
        <order>DESC</order>
        <sort>id</sort>
        <state>1</state>
        <type></type>
        <brand></brand>
        <serie></serie>
        <articul></articul>
        <brand_id></brand_id>
        <product_id></product_id>
        <search></search>
    </request>
    <items>
        <item>
	    <id></id>
            <product_id></product_id>
            <parent_id></parent_id>
            <price></price>
            <oldprice></oldprice>
            <available></available>
            <guarantee></guarantee>
            <ean>0</ean>
            <category>
                <categoryId></categoryId>
                <parentId></parentId>
                <name></name>
                <alias></alias>
            </category>
            <supplier>
                <id></id>
                <dropshipping></dropshipping>
                <pay_online></pay_online>
            </supplier>
            <seller>
                <id>0</id>
                <name></name>
            </seller>
            <delivery>
                <terms>Бесплатная по Украине.</terms>
            </delivery>
            <currency>
                <currency_id>UAH</currency_id>
                <short_sign>₴</short_sign>
                <currency_name>грн.</currency_name>
            </currency>
            <name></name>
            <type></type>
            <brand brand_id=""></brand>
            <vendor vendor_id=""></vendor>
            <serie></serie>
            <articul></articul>
            <url></url>
            <images>
	        <image sort="1"></image>
                <image sort="2"></image>
            </images>
            <description>Описание</description>
            	<param name=""></param>
            	<param name=""></param>
        </item>
    </items>
</body>
```


### Документация по работе с PLLANO REST API
* [Список всех ресурсов PLLANO REST API](docs/query.md)
	* [Прайс-листы: Получить список товаров](docs/price.md)
	* [Прайс-листы: Конкретный товар](docs/price.md#item)
	* [Поиск: Получить список товаров](docs/search.md)
	* [Поиск: Конкретный товар](docs/search.md#item)

<a name="php"></a>
## [PLLANO PHP HTTP client](src/Api.php)

### Легкий старт

Скачайте файлы [test.php](test.php) и [src/Api.php](src/Api.php) положите их в корень вашего сайта.

Запуск: `http://example.com/test.php`

PLLANO REST API PHP обратится по адресу:

[https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10](https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10)

В ответ получит массив json конвертирует его в массив PHP

<a name="composer"></a>

 Установка PLLANO PHP HTTP client с помощью Composer
 -------

### Требования

PHP >= 5.3*

```
$ composer require pllano/api
```
composer.json
``` json
"require": {
	"pllano/api": "1.0.3"
}
```
<a name="test"></a>
### Пример использования PLLANO PHP HTTP client

``` php	
require '../vendor/autoload.php'; // Подключить Composer
// require_once __DIR__.'/Api.php';
	
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
```

### Пример использования Guzzle

```
$ composer require guzzlehttp/guzzle
```
composer.json
``` json
"require": {
	"guzzlehttp/guzzle": "^6.3"
}
```

``` php	
require '../vendor/autoload.php'; // Подключить Composer

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://ua.pllano.com/api/v1/json/price/?public_key=test');
$output = $response->getBody();

// Чистим все что не нужно, иначе json_decode не сможет конвертировать json в массив
for ($i = 0; $i <= 31; ++$i) {$output = str_replace(chr($i), "", $output);}
$output = str_replace(chr(127), "", $output);
if (0 === strpos(bin2hex($output), 'efbbbf')) {$output = substr($output, 3);}

$records = json_decode($output, true);

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
```

<a name="feedback"></a>
## Поддержка, обратная связь, новости

Общайтесь с нами через почту api@pllano.com

Если вы нашли баг в работе PLLANO REST API или PLLANO PHP HTTP client загляните в
[issues](https://github.com/pllano/pllano-api/issues), возможно, про него мы уже знаем и
чиним. Если нет, лучше всего сообщить о нём там. Там же вы можете оставлять свои
пожелания и предложения.

За новостями вы можете следить по
[коммитам](https://github.com/pllano/pllano-api/commits/master) в этом репозитории.
[RSS](https://github.com/pllano/pllano-api/commits/master.atom).

Лицензия на библиотеку PLLANO REST API PHP
-------

The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.
