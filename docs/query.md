# Все ресурсы PLLANO REST API

### API - Всегда возвращает код 200 даже при логических ошибках !

`HTTP/1.1 200 OK`

`Content-Type: application/json`

### При этом в теле ответа API вернет код ошибки, статус и описание ошибки.
### [Список ошибок](errors.md)

```json
{
    "api": "v1.0",
    "query": "GET",
    "model": "price",
    "total": "",
    "limit": "",
    "offset": "",
    "order": "",
    "sort": "",
    "state": "",
    "type": "",
    "brand": "",
    "serie": "",
    "articul": "",
    "brand_id": "",
    "product_id": "",
    "search": "",
    "header": {
        "status": "404",
        "code": "404",
        "message": "404 Not Found"
    },
    "source": []
}
```

<a name="test"></a>
### Тестовые данные

`https://ua.pllano.com/api/v1/{format}/{model}/?public_key=test`

Возвращает список товаров для демонстрации и настройки работы с API с вашей стороны

<a name="resources"></a>
## Список всех ресурсов

Логика обращения к API выглядит следующим образом

`https://{country}.pllano.com/api/v1/{format}/{model}/{uid}`

`{country}` - страна по умолчанию ua

`{format}` - формат json или xlm

`{model}` - модель к которой обращаемся. Например price или search

`{uid}` - уникальный индефикатор записи

URL | Тип | Описание | Список запросов
----- | --- | -------- | ---
/api/v1/{format}/price/ | GET | Список товаров | 
/api/v1/{format}/price/{uid} | GET | Товар с указанным uid | 
/api/v1/{format}/search/ | GET | Список товаров
/api/v1/{format}/search/{uid} | GET | Товар с указанным uid | 

