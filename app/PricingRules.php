<?php

namespace MiniCheckoutSystem;

class PricingRules
{
    public function buyOneGetOne($product)
    {
        return $product['price'] * ceil($product['quantity'] / 2);
    }

    public function reducePrice($product)
    {
        if ($product['quantity'] >= 3) {
            $product['price'] = 4.50;
        }

        return $product['quantity'] * $product['price'];
    }
}
