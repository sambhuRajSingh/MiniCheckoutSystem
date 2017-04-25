<?php

namespace MiniCheckoutSystem;

class PricingRules
{
    public $products;

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function buyOneGetOne($product)
    {
        return $product['price'] * ceil($product['quantity'] / 2);
    }

    public function reducePrice($product)
    {
        if ($product['quantity'] >= 3) {
            echo "greater than or equal to three";
            return $product['price'] = 4.50;
        }

        return $product['price'];
    }
}
