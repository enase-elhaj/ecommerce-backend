<?php
namespace App\Models;

class Order{
    public $order_id;
    public $product_id;
    public $attributes;
    public $product_price;
    public $quantity;

    public function __construct(
        $order_id,
        $product_id,
        $attributes,
        $product_price,
        $quantity,
    ) {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->attributes = $attributes;
        $this->product_price = $product_price;
        $this->quantity = $quantity;
    }

}
