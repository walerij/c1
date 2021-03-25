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


class DailyRateItem
{
    protected $date;
    protected $valueId;
    protected $numCode;
    protected $charCode;
    protected $nominal;
    protected $name;
    protected $value;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getValueId()
    {
        return $this->valueId;
    }

    /**
     * @return mixed
     */
    public function getNumCode()
    {
        return $this->numCode;
    }

    /**
     * @return string
     */
    public function getCharCode()
    {
        return $this->charCode;
    }

    /**
     * @return mixed
     */
    public function getNominal()
    {
        return $this->nominal;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $valueId
     */
    public function setValueId($valueId)
    {
        $this->valueId = $valueId;
    }

    /**
     * @param mixed $numCode
     */
    public function setNumCode($numCode)
    {
        $this->numCode = $numCode;
    }

    /**
     * @param mixed $charCode
     */
    public function setCharCode($charCode)
    {
        $this->charCode = $charCode;
    }

    /**
     * @param mixed $nominal
     */
    public function setNominal($nominal)
    {
        $this->nominal = $nominal;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}