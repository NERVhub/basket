<?php
include 'Basket.php';

$product1 = new Product('Red Widget', 'R01', 32.95);
$product2 = new Product('Green Widget', 'G01', 24.95);
$product3 = new Product('Blue Widget', 'B01', 7.95);
$catalogue = array($product1, $product2, $product3);

$rule1 = new Rule(50, '<', 4.95);
$rule2 = new Rule(90, '<', 2.95);
$rule3 = new Rule(90, '>=', 0);
$rules = array($rule1, $rule2, $rule3);

$offer = new Offer('Buy one red widget, get the second half price', $product1, 2);
$offers = array($offer);

$basket = new Basket($catalogue, $rules, $offers);
$basket->addProduct($product3);
$basket->addProduct($product2);
echo $basket->getProductCodes();
echo "\t\t\t";
echo $basket->getTotal();
echo "\n";

$basket = new Basket($catalogue, $rules, $offers);
$basket->addProduct($product1);
$basket->addProduct($product1);
echo $basket->getProductCodes();
echo "\t\t\t";
echo $basket->getTotal();
echo "\n";

$basket = new Basket($catalogue, $rules, $offers);
$basket->addProduct($product1);
$basket->addProduct($product2);
echo $basket->getProductCodes();
echo "\t\t\t";
echo $basket->getTotal();
echo "\n";

$basket = new Basket($catalogue, $rules, $offers);
$basket->addProduct($product3);
$basket->addProduct($product3);
$basket->addProduct($product1);
$basket->addProduct($product1);
$basket->addProduct($product1);
echo $basket->getProductCodes();
echo "\t\t";
echo $basket->getTotal();
echo "\n";