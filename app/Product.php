<?php

namespace MiniCheckoutSystem;

class Product
{
    public $productCode;
    public $productName;
    public $productPrice;

    public function __construct($productCode, $productName, $productPrice)
    {
        $this->productCode = $productCode;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
    }
}
