# Все ресурсы PLLANO REST API

### Адрес PLLANO REST API

`https://{country}.pllano.com/api/v1/{format}/{model}/{uid}`

`{country}` - страна по умолчанию ua

`{format}` - формат json или xlm

`{model}` - модель к которой обращаемся. Например price или search

`{uid}` - уникальный индефикатор записи

### GET запрос к PLLANO REST API

`?public_key={public_key}&order={order}&sort={sort}&offset={offset}&limit={limit}`

`{public_key}` - Ваш ключ PLLANO REST API

`{limit}` - Записей на страницу. По умолчанию 10

`{offset}` - Страница. По умолчанию 0

`{order}` - Тип сортировки. По умолчанию asc

`{sort}` - Поле сортировки. По умолчанию uid

### API - Всегда возвращает код 200 даже при логических ошибках !

`HTTP/1.1 200 OK`

`Content-Type: application/json`

### При этом в теле ответа API вернет код ошибки, статус и описание ошибки.

#### [Коды ошибок HTTP PLLANO REST API](errors.md)

<a name="test"></a>
### Тестовые данные

`https://ua.pllano.com/api/v1/{format}/{model}/?public_key=test`

Возвращает список товаров для демонстрации и настройки работы с API с вашей стороны

<a name="resources"></a>

URL | Тип | Описание | Список запросов
----- | --- | -------- | ---
/api/v1/{format}/price/ | GET | Список товаров | 
/api/v1/{format}/price/{uid} | GET | Товар с указанным uid | 
/api/v1/{format}/search/ | GET | Список товаров
/api/v1/{format}/search/{uid} | GET | Товар с указанным uid | 

