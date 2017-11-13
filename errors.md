# Коды ошибок HTTP PLLANO REST API

## HTTP/1.1 200 OK

### PLLANO REST API - Всегда возвращает код 200 даже при логических ошибках !

`HTTP/1.1 200 OK`

`Content-Type: application/json`

### В теле ответа PLLANO REST API вернет код ошибки, статус и описание ошибки.

```json
{
    "header": {
        "status": "200 OK",
        "code": "200",
        "message": "OK"
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
    "price": {
        "items": [
            {
                "item": {}
            }
         ]
    }
}
```

### Коды ошибок HTTP которые отдает PLLANO REST API


* `200 OK`

* `201 Created` - Запись создана

* `304 Not Modified` - Данные не изменились

* `400 Bad Request` - Некорректный запрос

* `401 Unauthorized` - Неавторизованный доступ

* `403 Forbidden` - Доступ запрещен

* `404 Not Found` - Данные не найдены

* `500 Internal server error` - Внутренняя ошибка сервера
