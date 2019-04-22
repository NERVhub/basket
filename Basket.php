<?php
include 'Product.php';
include 'Rule.php';
include 'Offer.php';


class Basket
{
    protected $_catalogue;
    protected $_rules;
    protected $_offers;

    protected $_products = array();

    /**
     * Basket constructor.
     *
     * @param $catalogue Product[] Product Catalogue
     * @param $rules Rule[] Delivery Charge Rules
     * @param $offers Offer[] Special Offers
     */
    public function __construct($catalogue, $rules = array(), $offers = array())
    {
        if (!is_array($catalogue)) {
            $catalogue = array($catalogue);
        }
        $this->_catalogue = array();
        foreach ($catalogue as $product) {
            $this->_catalogue[$product->getCode()] = $product;
        }
        $this->_rules = array();
        foreach ($rules as $rule) {
            $this->_rules["{$rule->getCost()}"] = $rule;
        }
        krsort($this->_rules);
        $this->_offers = array();
        foreach ($offers as $offer) {
            $this->_offers[$offer->getProductCode()] = $offer;
        }
    }

    /**
     * Add Product to Basket
     *
     * @param $product Product
     */
    public function addProduct($product)
    {
        $count = 0;
        $code = $product->getCode();
        if (key_exists($code, $this->_products)) {
            $count = $this->_products[$code];
        }
        foreach ($this->_catalogue as $catalogueProduct) {
            if ($code == $catalogueProduct->getCode()) {
                $this->_products[$code] = ++$count;
                break;
            }
        }
    }

    /**
     * Get Basket total
     *
     * @return float|int
     */
    public function getTotal()
    {
        $subtotal = $this->getSubtotal();
        $deliveryCost = $this->getDeliveryCost($subtotal);
        $total = $subtotal + $deliveryCost;

        return "$".$total;
    }

    /**
     * Get Basket subtotal
     *
     * @return int
     */
    public function getSubtotal() {
        $subtotal = 0;

        foreach ($this->_products as $code => $count) {
            $product = $this->_catalogue[$code];
            for ($i = 1; $i <= $count; $i++) {
                if (key_exists($code, $this->_offers)) {
                    $offer = $this->_offers[$code];
                    if ($i%$offer->getCount()) {
                        $subtotal += $product->getPrice();
                    } else {
                        $subtotal += $offer->getPrice();
                    }
                } else {
                    $subtotal += $product->getPrice();
                }
            }
        }

        return $subtotal;
    }

    /**
     * Get Basket Subtotal
     *
     * @param $subtotal float
     *
     * @return float
     */
    public function getDeliveryCost($subtotal) {
        $deliveryCost = 0;
        $rules = $this->_rules;
        if (!empty($rules)) {
            $deliveryCost = $rules[0];
        }
        foreach ($this->_rules as $rule) {
            if ($this->_checkRule($subtotal, $rule)) {
                $deliveryCost = $rule->getCost();
                break;
            }
        }

        return $deliveryCost;
    }

    /**
     * Check if Subtotal matches the Rule
     *
     * @param $subtotal float
     * @param $rule Rule
     *
     * @return bool
     */
    protected function _checkRule($subtotal, $rule)
    {
        $result = false;

        switch ($rule->getCondition()) {
            case '>=':
                if ($subtotal >= $rule->getSubtotal()) {
                    $result = true;
                }
                break;
            case '<=':
                if ($subtotal <= $rule->getSubtotal()) {
                    $result = true;
                }
                break;
            case '>':
                if ($subtotal > $rule->getSubtotal()) {
                    $result = true;
                }
                break;
            case '<':
                if ($subtotal < $rule->getSubtotal()) {
                    $result = true;
                }
                break;
            case '=':
                if ($subtotal == $rule->getSubtotal()) {
                    $result = true;
                }
                break;
            default:
                break;
        }

        return $result;
    }

    /**
     * Get Basket product codes
     *
     * @return string
     */
    public function getProductCodes()
    {
        $codes = array();

        foreach ($this->_products as $code => $count) {
            $codes = array_merge($codes, array_fill(0, $count, $code));
        }

        return implode(', ', $codes);
    }
}