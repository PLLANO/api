# PLLANO API
Документация по работе с PLLANO API

PLLANO RESTful API — это бесплатный инструментарий для интеграции [pllano.com](https://pllano.com/) в ваш продукт.

Вы можете ипользовать наш [PLLANO PHP HTTP client](src/Api.php) или популярный PHP HTTP client [Guzzle](https://github.com/guzzle/guzzle) - [Документация](http://docs.guzzlephp.org/en/stable/)

<a name="general"></a>
## PLLANO API работает согластно стантарту [APIS-2018](https://github.com/pllano/APIS-2018)
#### Используйте документацию [APIS-2018](https://github.com/pllano/APIS-2018)
#### Список всех ресурсов PLLANO API соответствует списку ресурсов [APIS-2018](https://github.com/pllano/APIS-2018)

## Новый адрес сервера API
https://api.pllano.com/

### PLLANO API потдерживает запросы:
- `POST /price` Создание записи 
- `POST /price/42` Ошибка
- `GET /price` Список прайс-строк
- `GET /price/42` Данные конкретной прайс-строки
- `PUT /price` Обновить данные прайс-строк
- `PUT /price/42` Обновить данные конкретной прайс-строки
- `DELETE /price` Удалить все прайс-строки
- `DELETE /price/42` Удалить конкретную прайс-строку

### URL PLLANO API
- `https://api.pllano.com/{resource}/{uid}`
- `{resource}` - ресурс к которому обращаемся. Например `price` или `search`
- `{id}` - уникальный индефикатор
### GET запрос к API
- `?public_key={public_key}&order={order}&sort={sort}&offset={offset}&limit={limit}`
- `{public_key}` - Ваш ключ к API
- `{limit}` - Записей на страницу. По умолчанию 10
- `{offset}` - Страница. По умолчанию 0
- `{order}` - Тип сортировки. По умолчанию ASC
- `{sort}` - Поле сортировки. По умолчанию id

### [Список всех ресурсов PLLANO API](https://github.com/pllano/APIS-2018)

### API - Всегда возвращает код 200 даже при логических ошибках !
`HTTP/1.1 200 OK`

`Content-Type: application/json`

### В теле ответа API вернет состояния HTTP или код ошибки.
[Коды состояния HTTP](https://github.com/pllano/APIS-2018/tree/master/http-codes)

### Демо
Перейдите по ссылке [https://api.pllano.com/price?public_key=test&order=asc&sort=uid&offset=0&limit=10](https://api.pllano.com/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10)

<a name="php"></a>
## [PLLANO PHP HTTP client](src/Api.php)

### Легкий старт

Скачайте файлы [test.php](test.php) и [src/Api.php](src/Api.php) положите их в корень вашего сайта.

Запуск: `http://example.com/test.php`

PLLANO REST API PHP обратится по адресу:

[https://api.pllano.com/price?public_key=test&order=asc&sort=uid&offset=0&limit=10](https://api.pllano.com/price?public_key=test&order=asc&sort=uid&offset=0&limit=10)

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
use GuzzleHttp\Client as Guzzle;
// Подключаем Guzzle
$client = new Guzzle();
// Отправляем запрос
$response = $client->request('GET', 'https://ua.pllano.com/api/v1/json/price/?public_key=test');
// Получаем тело ответа
$output = $response->getBody();
$records = json_encode(json_decode($output, true), JSON_PRETTY_PRINT);
// Вывести на экран json
print_r($records);
```

### Структура ответа API в json формате
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
        "auth": "QueryKeyAuth",
        "total": "1000"
    },
    "request": {
        "query": "GET",
        "resource": "price",
        "limit": "10",
        "offset": "0",
        "order": "DESC",
        "sort": "id",
        "state": "1",
        "type": "",
        "brand": "",
        "serie": "",
        "articul": "",
        "search": ""
    },
    "body": {
        "items": [
            {
                "item": {
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

The MIT License (MIT). Please see [LICENSE](https://github.com/pllano/pllano-api/blob/master/LICENSE.md) for more information.
