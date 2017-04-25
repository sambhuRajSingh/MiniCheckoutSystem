<?php

namespace MiniCheckoutSystem;

class Checkout
{
    public $total = 0;
    public $basket = [];

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

            $class = __NAMESPACE__ . '\\' . $code . 'PricingRules';

            if(class_exists($class)) {
                $this->total += (new $class)->offer($product);
            } else {
                $this->total += $product['price'] * $product['quantity'];
            }
        }

        return $this->total;
    }
}
