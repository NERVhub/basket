<?php


class Rule
{
    protected $_subtotal;
    protected $_condition;
    protected $_cost;

    /**
     * Rule constructor.
     *
     * @param $subtotal float
     * @param $condition string
     * @param $cost float
     */
    public function __construct($subtotal, $condition, $cost)
    {
        $this->_subtotal = $subtotal;
        $this->_condition = $condition;
        $this->_cost = $cost;
    }

    public function getSubtotal()
    {
        return $this->_subtotal;
    }

    public function getCondition()
    {
        return $this->_condition;
    }

    public function getCost()
    {
        return $this->_cost;
    }
}