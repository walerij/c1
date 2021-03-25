<?php
  class Privet {
      
    use AndyDune\CurrencyRateCbr\DailyRate;
      function __construct()
      {
           
      }
      function hello($name="John")
      {
          return "hello,"+$name;
      }

      function hi($hello="Привет",$name="Валера")
      {
          return $hello+","+$name+"!";
      }
       function hi_test($name="")
       {
           return "test";
       }

       function getVal($val="usd")
       {
            $rate = new DailyRate();
            $rate->setDate(new \DateTime()); // не обязательно - по умолчанию используется текущая дата 
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

            return $item->getValue();
       }
    

  }