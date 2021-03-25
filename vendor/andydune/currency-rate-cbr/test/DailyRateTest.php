<?php
/**
 * Code for obtaining and parsing XML-data on currency rates of the Central Bank of the Russian Federation.
 * PHP version 5.6, 7.X
 *
 * About:
 * http://www.cbr.ru/development/SXML/
 *
 * @package andydune/currency-rate-cbr
 * @link  https://github.com/AndyDune/CurrencyRateCbr for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2018 Andrey Ryzhov
 */


namespace AndyDuneTest\CurrencyRateCbr;

use AndyDune\CurrencyRateCbr\DailyRate;
use AndyDune\CurrencyRateCbr\DailyRateItem;
use AndyDune\CurrencyRateCbr\DailyRateParseXml;
use AndyDune\CurrencyRateCbr\Request;
use PHPUnit\Framework\TestCase;

class DailyRateTest extends TestCase
{
    public function testRequest()
    {
        $request = new Request();
        $request->execute();
        $this->assertEquals(200, $request->getResponseCode());
        $this->assertEquals(null, $request->getRequestError());
        $body = $request->getResponseBody();
        $this->assertTrue((bool)preg_match('|<\?xml version="1.0"|', $body));

        $request->execute(Request::URI_XML_DAILY);
        $this->assertEquals(200, $request->getResponseCode());
        $this->assertEquals(null, $request->getRequestError());

        $request->execute('http://www.cbr.ru/scripts/XML_daily_nope.asp');
        $this->assertEquals(200, $request->getResponseCode());
        $this->assertEquals(null, $request->getRequestError());
        $body = $request->getResponseBody();
        $this->assertTrue((bool)preg_match('|Ошибка 404|', $body));


        $request->execute('sdsds');
        $this->assertEquals(null, $request->getResponseCode());
        $this->assertEquals(null, $request->getResponseCode());
        $this->assertInstanceOf(\Exception::class, $request->getRequestError());
        $this->assertEquals(null, $request->getResponseBody());
        $this->assertEquals('cURL error 6: Could not resolve host: sdsds (see http://curl.haxx.se/libcurl/c/libcurl-errors.html)', $request->getRequestError()->getMessage());

        $request->execute(11);
        $this->assertEquals(null, $request->getResponseCode());
        $this->assertInstanceOf(\Exception::class, $request->getRequestError());

    }

    public function testParseXml()
    {
        $xmlStr = file_get_contents(__DIR__ . '/xml_daily.xml');
        //$xmlStr = iconv('windows-1251', 'UTF-8', $xmlStr);
        $parse = new DailyRateParseXml();
        $data = $parse->parse($xmlStr);
        $this->assertArrayHasKey('USD', $data);
        /** @var DailyRateItem $item */
        $item = $data['USD'];
        $this->assertInstanceOf(\DateTime::class, $item->getDate());
        $this->assertNotEquals(null, $item->getCharCode());
        $this->assertNotEquals(null, $item->getValue());
        $this->assertNotEquals(null, $item->getNominal());
        $this->assertNotEquals(null, $item->getName());
        $this->assertNotEquals(null, $item->getValueId());
        $this->assertNotEquals(null, $item->getNumCode());
    }

    public function testDailyRate()
    {
        $rate = new DailyRate();
        $result = $rate->retrieve();
        $this->assertTrue($result);

        $item = $rate->get('usd');
        $this->assertInstanceOf(\DateTime::class, $item->getDate());
        $this->assertNotEquals(null, $item->getCharCode());
        $this->assertNotEquals(null, $item->getValue());
        $this->assertNotEquals(null, $item->getNominal());
        $this->assertNotEquals(null, $item->getName());
        $this->assertNotEquals(null, $item->getValueId());
        $this->assertNotEquals(null, $item->getNumCode());

    }
}