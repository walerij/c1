<?php
/**
 * Code for obtaining and parsing XML-data on currency rates of the Central Bank of the Russian Federation.
 *
 * @package andydune/currency-rate-cbr
 * @link  https://github.com/AndyDune/CurrencyRateCbr for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2018 Andrey Ryzhov
 */


namespace AndyDune\CurrencyRateCbr;


class DailyRateParseXml
{
    public function parse($xml)
    {
        $data = [];
        $simple = new \SimpleXMLElement($xml);
        $date = (string)$simple->attributes()->Date;
        $date = \DateTime::createFromFormat('d.m.Y', $date);
        foreach ($simple->Valute as $row) {
            $item = new DailyRateItem();
            $item->setDate($date);
            $item->setValue((string)$row->Value);
            $item->setValueId((string)$row->attributes()->ID);
            $item->setCharCode((string)$row->CharCode);
            $item->setName((string)$row->Name);
            $item->setNumCode((string)$row->NumCode);
            $item->setNominal((string)$row->Nominal);
            $data[$item->getCharCode()] = $item;
        }
        return $data;
    }
}