<?php

namespace App\Models;

class Category {
    public $name;
    public $products = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }
}
