# basket

This application shows the total cost of the product basket.

## Usage:
Include Basket.php to your script.

### Create products (title, code, price) and product catalogue:

$product1 = new Product('Red Widget', 'R01', 32.95);<br>
$product2 = new Product('Green Widget', 'G01', 24.95);<br>
$product3 = new Product('Blue Widget', 'B01', 7.95);<br>
$catalogue = array($product1, $product2, $product3);

### Create delivery charge rules (basket subtotal, subtotal condition(>=,<=,>,<,=), delivery cost):

$rule1 = new Rule(50, '<', 4.95);<br>
$rule2 = new Rule(90, '<', 2.95);<br>
$rule3 = new Rule(90, '>=', 0);<br>
$rules = array($rule1, $rule2, $rule3);

### Create special offers (title, product, count), *count - half price of every **count** product

$offer = new Offer('Buy one red widget, get the second half price', $product1, 2);<br>
$offers = array($offer);

### Create the basket (product catalogue, delivery charge rules, special offers) and add products to it:

$basket = new Basket($catalogue, $rules, $offers);
$basket->addProduct($product3);
$basket->addProduct($product3);
$basket->addProduct($product1);
$basket->addProduct($product1);
$basket->addProduct($product1);

### To get list of basket product codes use getProductCodes() function:

echo $basket->getProductCodes();

### To get basket total use getTotal() function:

echo $basket->getTotal();