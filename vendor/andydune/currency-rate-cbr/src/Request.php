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


namespace AndyDune\CurrencyRateCbr;
use GuzzleHttp\Client;

class Request
{
    protected $uriList = [
        1 => 'http://www.cbr.ru/scripts/XML_daily.asp'
    ];
    protected $query = [];

    const URI_XML_DAILY = 1;

    /**
     * @var \Exception
     */
    protected $requestError = null;

    protected $responseCode = null;
    protected $responseContentType = null;
    protected $responseBody = null;

    public function execute($uri = null)
    {
        if (!$uri) {
            $uri = self::URI_XML_DAILY;
        }

        try {
            $client = new Client();
            $res = $client->request('GET', $this->buildUri($uri));
            $this->requestError = null;
            $this->responseCode = $res->getStatusCode(); // 200
            $this->responseContentType = $res->getHeaderLine('content-type'); // application/xml; charset=windows-1251
            $this->responseBody = $res->getBody()->getContents(); // xml body
            return true;

        } catch (\Exception $e) {
            $this->responseCode = null;
            $this->responseContentType = null;
            $this->responseBody = null;
            $this->requestError = $e;
        }
        return false;
    }

    /**
     * @return \Exception|null
     */
    public function getRequestError()
    {
        return $this->requestError;
    }

    /**
     * @return null|int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @return null|string
     */
    public function getResponseContentType()
    {
        return $this->responseContentType;
    }

    /**
     * @return null|string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }


    public function addQuery($key, $value)
    {
        $this->query[$key] = $value;
        return $this;
    }

    protected function buildUri($uri)
    {
        if (is_string($uri)) {
            $path = $uri;
        } else if (array_key_exists($uri, $this->uriList)) {
            $path = $this->uriList[$uri];
        } else {
            throw new \Exception('Bad uri');
        }
        if ($this->query) {
            $path .= '?' . http_build_query($this->query);
        }
        return $path;
    }
}