<?php

namespace MiniCheckoutSystem;

interface PricingRules
{
    public function offer($products);
}
