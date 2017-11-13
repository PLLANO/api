# Товары и Прайс-листы с наличием

* [Список товаров](#list)
* [Конкретный товар](#item)
  * [Изменяем цену для маркетплейсов](#marketplace-item-edit)

<a name="list"></a>

### Логика обращения к API

`https://{country}.pllano.com/api/v1/{format}/{model}/{uid}`

`{country}` - страна по умолчанию ua

`{format}` - формат json или xlm

`{model}` - модель к которой обращаемся. Например price или search

`{uid}` - уникальный индефикатор записи

### Тестовые данные

`https://ua.pllano.com/api/v1/json/price/?public_key=test` возвращает список товаров для демонстрации и настройки работы API с вашей стороны

## Список товаров

Запрос `GET /api/v1/{format}/price/` возвращает список всех ваших товаров. 

## Тело запроса

```json
{
"public_key": "test",
"query": "GET",
"model": "price",
"limit": 10,
"offset": 0,
"order": "DESC",
"sort": "uid",
"state": 1,
"type": null,
"brand": null,
"serie": null,
"articul": null,
"brand_id": null,
"product_id": null,
"search": null
}
```

Без `public_key` вернёт `403 Forbidden`.

Имя | По умолчанию | Тип | Описание
--- | ---- | --- | --------
public_key | test | string | Если пустое или неверное значение - API отдаст ошибку 403 с кодом `200 OK`
api | v1.0 | string | Версия API
query | null | string | Не обезетельно. Дублируем тип запроса GET, POST, PUT, DELETE. Если значение указано то оно имеет выше приоритет чем в заголовке.
model | index | string | Модель
total | 0 | boolean | Колличество найденых товаров
limit | 10 | boolean | Лимит вывода товаров на страницу.
offset | 0 | boolean | Страница (смещение)
order | DESC | string | Сортировка DESC или ASC
sort | uid | string | Поле сортировки
state | 1 | boolean | Статус товара активен 1 если неактивен 0
type | null | string | Поиск по указанному типу товара
brand | null | string | Поиск по указанному бренду товара
serie | null | string | Поиск по указанной серии (модели) товара
articul | null | string | Поиск по указанному артикулу товара
brand_id | null | boolean | Товары конкретного бренда
product_id | null | boolean | id товара
search | null | string | Полнотекстовый поисковый запрос

### Ответ

Успешный ответ приходит с кодом `200 OK` и содержит тело:

`HTTP/1.1 200 OK`

`Content-Type: application/json`

```json
{
"api": "v1.0",
"query": "GET",
"model": "price",
"total": 20755,
"limit": 10,
"offset": 0,
"order": "DESC",
"sort": "uid",
"state": 1,
"type": null,
"brand": null,
"serie": null,
"articul": null,
"brand_id": null,
"product_id": null,
"search": null,
"source": [
    {
    "uid": "7a064a035722 - уникальный id на платформе",
    "product_id": "id товара на платформе",
    "supplier_product_id": "id товара у поставщика",
    "seller_product_id": "id товара на вашем сайте",
    "category_id": "id категории на вашем сайте",
    "price": "462.00 - Цена",
    "oldprice": "0.00 - Старая цена",
    "price_dealer": "415.80 - Оптовая цена",
    "price_out": "466.62 - Цена на маркетплейсы",
    "oldprice_out": "0.00 - Старая цена на маркетплейсы",
    "currency_id": "id валюты (1 = UAH, 2 - USD, 3 - EUR)",
    "available": "Наличие - целое число. (0 - нет в наличии, 1-9998 колличество, 9999 - производится до 3 дней.",
    "pay_online": "Безнличный расчет - 0 или 1 (0 нет, 1 да)",
    "dropshipping": "Дропшиппинг - 0 или 1 (0 нет, 1 да)",
    "guarantee": "гарантия целое число 12",
    "terms_of_delivery": "Стоимость доставки цифра от 1 до 20",
    "name": "Полное название товара на платформе",
    "type": "Тип товара",
    "brand": "Бренд",
    "serie": "Серия (Модель) товара",
    "articul": "Артикул, цвет итд.",
    "seller_product_name": "Название товара на вашем сайте"
    }
  ]
}
```

<a name="item"></a>
## Просмотр товара

`GET /api/v1/{format}/price/{uid}`

где `uid` – уникальный идентификатор товара на нашей платформе.

### Ответ

Успешный ответ приходит с кодом `200 OK` и содержит тело:

```json
{
  "api": "v1.0",
  "query": "GET",
  "model": "price",
  "source": {
    "uid": "7a064a035722 - уникальный id на платформе",
    "product_id": "id товара на платформе",
    "supplier_product_id": "id товара у поставщика",
    "seller_product_id": "id товара на вашем сайте",
    "category_id": "id категории на вашем сайте",
    "price": "462.00 - Цена",
    "oldprice": "0.00 - Старая цена",
    "price_dealer": "415.80 - Оптовая цена",
    "price_out": "466.62 - Цена на маркетплейсы",
    "oldprice_out": "0.00 - Старая цена на маркетплейсы",
    "currency_id": "id валюты (1 = UAH, 2 - USD, 3 - EUR)",
    "available": "Наличие - целое число. (0 - нет в наличии, 1-9998 колличество, 9999 - производится до 3 дней.",
    "pay_online": "Безнличный расчет - 0 или 1 (0 нет, 1 да)",
    "dropshipping": "Дропшиппинг - 0 или 1 (0 нет, 1 да)",
    "guarantee": "гарантия целое число 12",
    "terms_of_delivery": "Стоимость доставки цифра от 1 до 20",
    "name": "Полное название товара на платформе",
    "type": "Тип товара",
    "brand": "Бренд",
    "serie": "Серия (Модель) товара",
    "articul": "Артикул, цвет итд.",
    "seller_product_name": "Название товара на вашем сайте"
    }
}
```

### Ошибки

* `404 Not Found` - если товар не существует или недоступный пользователю.

