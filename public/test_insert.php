<?php

// test_insert.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/GraphQL/resolver.php';

// Sample data for the new product
$sampleProductData = [
    'product_id' => 'rayan',
    'product_name' => 'omniaaaTest22 Product',
    'product_description' => 'wwwwwfor Test222 Product',
    'category_id' => 2, // Replace with a valid category ID
    'brand' => '8Brand',
    'product_price' => 800,
    'stock' => 80
];

// Call the resolver function with the sample data
$result = \App\GraphQL\createProductResolver(null, $sampleProductData);

if ($result) {
    echo "Product inserted successfully. Product ID: " . $result->product_id;
} else {
    echo "Failed to insert product.";
}
