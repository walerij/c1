# Курсы валют ЦБ России

[![Build Status](https://travis-ci.org/AndyDune/CurrencyRateCbr.svg?branch=master)](https://travis-ci.org/AndyDune/CurrencyRateCbr)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/andydune/currency-rate-cbr.svg?style=flat-square)](https://packagist.org/packages/andydune/currency-rate-cbr)
[![Total Downloads](https://img.shields.io/packagist/dt/andydune/currency-rate-cbr.svg?style=flat-square)](https://packagist.org/packages/andydune/currency-rate-cbr)


Библиотека для получения и парсинга XML-данных о курсах валют.

Источник данных: [Получение данных, используя XML](http://www.cbr.ru/development/SXML/)


Уставнока
------------

Уставнока через композер:

```
composer require andydune/currency-rate-cbr
```
Or if composer was not installed globally:
```
php composer.phar require andydune/currency-rate-cbr
```
Or edit your `composer.json`:
```
"require" : {
     "andydune/currency-rate-cbr": "^1"
}

```
Запустить команду:
```
php composer.phar update
```

Использование
--------------

```php
use AndyDune\CurrencyRateCbr\DailyRate;

$rate = new DailyRate();
$rate->setDate(new \DateTime()); // не оюязательно - по умолчанию используется текущая дата 
$isOk = $rate->retrieve(); // true если данные успешно получены

// Извлекаем курс доллара 

/** @var DailyRateItem $item */
$item = $rate->get('usd'); // код валюты, регистр не важен

$item->getDate(); // \DateTime::class - объект даты
$item->getCharCode(); // код валюты: USD
$item->getValue(); // цена: 63,1394
$item->getNominal(); // номинал: 1
$item->getName(); // наименование: Доллар США
$item->getValueId(); // ID валюты: R01235
$item->getNumCode(); // числовой код: 208
```