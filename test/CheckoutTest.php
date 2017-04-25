<?php

namespace test;

use MiniCheckoutSystem\Product;
use PHPUnit_Framework_TestCase;
use MiniCheckoutSystem\Items;
use MiniCheckoutSystem\Checkout;

class CheckoutTest extends PHPUnit_Framework_TestCase
{
    public function testGivenPurchasingThreeItemsOfFruitTeaShouldGiveBuyOneGetOneFree()
    {
        $fruitTea = new Product('FR', 'Fruit tea', 3.11);
        $strawberries = new Product('SR', 'Strawberries', 5.00);
        $coffee = new Product('CF', 'Coffee', 11.23);

        $checkout = new Checkout();

        $checkout->scan($fruitTea);
        $checkout->scan($strawberries);
        $checkout->scan($fruitTea);
        $checkout->scan($fruitTea);
        $checkout->scan($coffee);
        $price = $checkout->getTotal();

        $this->assertEquals(22.45, $price);
    }

    public function testGivenPurchasingTwoItemsOfFruitTeaShouldGiveOneFreeItem()
    {
        $fruitTea = new Product('FR', 'Fruit tea', 3.11);

        $checkout = new Checkout();

        $checkout->scan($fruitTea);
        $checkout->scan($fruitTea);
        $price = $checkout->getTotal();

        $this->assertEquals(3.11, $price);
    }

    public function testGivenPurchasingThreeItemsOfStrawberriesShouldReducePriceOfStrawberry()
    {
        $fruitTea = new Product('FR', 'Fruit tea', 3.11);
        $strawberries = new Product('SR', 'Strawberries', 5.00);

        $checkout = new Checkout();

        $checkout->scan($strawberries);
        $checkout->scan($strawberries);
        $checkout->scan($fruitTea);
        $checkout->scan($strawberries);
        $price = $checkout->getTotal();

        $this->assertEquals(16.61, $price);
    }
}
