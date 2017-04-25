<?php

namespace MiniCheckoutSystem;

use MiniCheckoutSystem\PricingRules;

class Checkout
{
    public $total = 0;
    public $basket = [];

    public function __construct(PricingRules $pricingRules)
    {
        $this->pricingRules = $pricingRules;
    }

    public function scan($product)
    {
        if (isset($this->basket[$product->code])) {
            $this->basket[$product->code]['quantity'] += 1;
        } else {
            $this->basket[$product->code]['quantity'] = 1;
            $this->basket[$product->code]['price'] = $product->price;
        }
    }

    public function getTotal()
    {
        foreach ($this->basket as $code => $product) {
            $price = $product['price'];
            if ($code == 'SR1') {
                $price = $this->pricingRules->reducePrice($product);
                $this->total += $price * $product['quantity'];
                continue;
            }

            if ($code == 'FR1') {
                $price = $this->pricingRules->buyOneGetOne($product);
                $this->total += $price;
                continue;
            }

            $this->total += $price * $product['quantity'];
        }

        return $this->total;
    }
}
