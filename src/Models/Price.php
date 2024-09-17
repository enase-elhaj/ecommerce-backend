<?php

namespace App\Models;

class Price {
    public $amount;
    public $currency_label;
    public $currency_symbol;
    public $product_id;

    public function __construct($amount, Currency $currency) {
        $this->amount = $amount;
        $this->currency_label = $currency_label;
        $this->currency_symbol= $currency_symbol;
        $this->product_id= $product_id;
    }
}
