<?php

namespace MiniCheckoutSystem;

class FRPricingRules implements PricingRules
{
    public function offer($products)
    {
        return $products['price'] * ceil($products['quantity'] / 2);
    }
}
