<?php

namespace MiniCheckoutSystem;

class Checkout
{
    public $total = 0;
    public $basket = [];

    public function __construct(PricingRules $pricingRules)
    {
        $this->pricingRules = $pricingRules;
    }

    public function scan(Product $product)
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
            if ($code == 'SR1') {
                $this->total += $this->pricingRules->reducePrice($product);
                continue;
            }

            if ($code == 'FR1') {
                $this->total += $this->pricingRules->buyOneGetOne($product);
                continue;
            }

            $this->total += $product['price'] * $product['quantity'];
        }

        return $this->total;
    }
}
