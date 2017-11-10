# PLLANO REST API

Библиотека и документация по работе с PLLANO REST API

PLLANO REST API — это бесплатный инструментарий для интеграции [PLLANO](https://ua.pllano.com/) в ваш продукт.

<a name="general"></a>
### Документация по работе с PLLANO REST API

* [Получить список товаров](docs/price.md)
* [Просмотр конкретного товара](docs/price.md#item)

<a name="php"></a>
## Готовая библиотека на PHP
-------
Мы разработали готовую библиотеку на PHP для работы с PLLANO REST API

### Пример работы
-------

Скачайте файлы [test.php](test.php) и [src/PllanoApi.php](src/PllanoApi.php) положите их в корень вашего сайта.

Запустите: `http://example.com/test.php`

PllanoApi обратится по адресу `https://ua.pllano.com/api/v1/json/price/?public_key=test&order=asc&sort=uid&offset=0&limit=10` и получит в ответ массив json конвертирует его в массив PHP

<a name="composer"></a>
### Требования
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
