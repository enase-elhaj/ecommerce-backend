<?php

// test_insert.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/GraphQL/resolver.php';

// Sample data for the new order
$sampleOrderData = [
    'product_id' => 'enas',        // Replace with a valid product ID from your products table
    'attributes' => 'Color: Red, Size: M', // Replace with relevant product attributes
    'product_price' => '200',         // Replace with the product price
    'quantity' => 2,                // Quantity of the product ordered
];

// Call the resolver function with the sample order data
$result = \App\GraphQL\placeOrderResolver(null, $sampleOrderData);

if ($result) {
    echo "Order placed successfully. Order ID: " . $result->product_id;
} else {
    echo "Failed to place order.";
}
