# Коды ошибок HTTP PLLANO REST API

## PLLANO REST API - Всегда возвращает код 200 даже при логических ошибках !

`HTTP/1.1 200 OK`

`Content-Type: application/json`

## В теле ответа PLLANO REST API вернет код ошибки, статус и описание ошибки.

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

## Коды ошибок HTTP которые отдает PLLANO REST API


* `200 OK`

* `201 Created` - Запись создана

* `304 Not Modified` - Данные не изменились

* `400 Bad Request` - Некорректный запрос

* `401 Unauthorized` - Неавторизованный доступ

* `403 Forbidden` - Доступ запрещен

* `404 Not Found` - Данные не найдены

* `500 Internal server error` - Внутренняя ошибка сервера
