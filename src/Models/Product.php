<?php
namespace App\Models;

class Product {
    public $product_id;
    public $product_name;
    public $inStock;
    public $product_description;
    public $category; 
    public $product_price;
    public $brand;
    public $attribute_1;
    public $attribute_2;
    public $attribute_3;
    public $image_1;
    public $image_2;
    public $image_3;
    public $image_4;
    public $image_5;
    public $image_6;
    public $image_7;

    public function __construct(
        $product_id,
        $product_name,
        $inStock,
        $product_description,
        $category,
        $product_price,
        $brand,
        $attribute_1 = null,
        $attribute_2 = null,
        $attribute_3 = null,
        $image_1 = null,
        $image_2 = null,
        $image_3 = null,
        $image_4 = null,
        $image_5 = null,
        $image_6 = null,
        $image_7 = null
    ) {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->inStock = $inStock;
        $this->product_description = $product_description;
        $this->category = $category;
        $this->product_price = $product_price;
        $this->brand = $brand;
        $this->attribute_1 = $attribute_1;
        $this->attribute_2 = $attribute_2;
        $this->attribute_3 = $attribute_3;
        $this->image_1 = $image_1;
        $this->image_2 = $image_2;
        $this->image_3 = $image_3;
        $this->image_4 = $image_4;
        $this->image_5 = $image_5;
        $this->image_6 = $image_6;
        $this->image_7 = $image_7;
    }
}
