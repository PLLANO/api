# PLLANO REST API

Библиотека и документация по работе с PLLANO REST API

PLLANO REST API — это бесплатный инструментарий для интеграции [PLLANO](https://ua.pllano.com/) в ваш продукт.

Требования
-------
 **PHP >= 5.3*

Установка
-------

Установка `PllanoApi` с помощью Composer.

```
$ composer require joomimart/csv
```

установка с помощью composer.json

```
"require": {
	"pllano/api": "v1.*"
}
```

Quickstart example => tests/QuickStart.php
-------

Save the above code fragment as `test.php` in your Web root folder.

``` php
require 'vendor/autoload.php';
//	require_once '/vendor/joomimart/csv/src/Reader.php';
//	require_once __DIR__.'/src/Reader.php';

$filename = 'test.csv';

$csv = new joomiMart\Csv\Reader($filename);

$records = $csv->Read();

$count = count($records);
if ($count >= 1) {
	foreach ($records as $item) {
			
		print_r($item);
		print_r('<br>');
		
	}
}
```

<a name="feedback"></a>
## Поддержка, обратная связь, новости

Общайтесь с нами через почту api@pllano.com

Если вы нашли баг в работе PLLANO REST API загляните в
[issues](https://github.com/hhru/api/issues), возможно, про него мы уже знаем и
чиним. Если нет, лучше всего сообщить о нём там. Там же вы можете оставлять свои
пожелания и предложения.

Если вы нашли проблему на одном из сайтов HeadHunter,
[напишите в поддержку по сайту](https://hh.ru/feedback) или в
[сообщество поддержки](https://feedback.hh.ru/).

За новостями вы можете следить по
[коммитам](https://github.com/hhru/api/commits/master) в этом репозитории.
[RSS](https://github.com/hhru/api/commits/master.atom).


Лицензия на библиотеку PLLANO REST API PHP
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
