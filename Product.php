<?php


class Product
{
    protected $_title;
    protected $_code;
    protected $_price;

    /**
     * Product constructor.
     *
     * @param $title string
     * @param $code string
     * @param $price float
     */
    public function __construct($title, $code, $price)
    {
        $this->_title = $title;
        $this->_code = $code;
        $this->_price = $price;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function getPrice()
    {
        return $this->_price;
    }
}