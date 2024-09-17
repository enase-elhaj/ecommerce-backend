<?php
namespace App\Models;

class Item {
    public $item_id;
    public $attribute_name;
    public $product_id;
    public $display_value;
    public $valuex;

    public function __construct(
        $item_id,
        $attribute_name,
        $product_id,
        $display_value = null, // Optional field
        $valuex = null // Optional field
    ) {
        $this->item_id = $item_id;
        $this->attribute_name = $attribute_name;
        $this->product_id = $product_id;
        $this->display_value = $display_value;
        $this->valuex = $valuex;
    }

}
