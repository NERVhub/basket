<?php


class Offer
{
    protected $_title;
    protected $_productCode;
    protected $_count;
    protected $_price;

    /**
     * Offer constructor.
     *
     * @param $title string
     * @param $product Product
     * @param $count int
     */
    public function __construct($title, $product, $count)
    {
        $this->_title = $title;
        $this->_productCode = $product->getCode();
        $this->_count = $count;
        if ($count > 0) {
            $this->_price = round($product->getPrice() / 2, 2, PHP_ROUND_HALF_DOWN);
        } else {
            $this->_price = $product->getPrice();
        }
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getProductCode()
    {
        return $this->_productCode;
    }

    public function getCount()
    {
        return $this->_count;
    }

    public function getPrice()
    {
        return $this->_price;
    }
}