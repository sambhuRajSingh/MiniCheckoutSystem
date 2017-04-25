<?php

namespace MiniCheckoutSystem;

class SRPricingRules implements PricingRules
{
    public function offer($products)
    {
        if ($products['quantity'] >= 3) {
            $products['price'] = 4.50;
        }

        return $products['quantity'] * $products['price'];
    }
}
