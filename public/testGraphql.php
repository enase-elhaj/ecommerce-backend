<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/GraphQL/Schema.php'; // Adjust path as needed

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

// Load your schema
$schema = require __DIR__ . '/../src/GraphQL/Schema.php'; // Adjust path as needed

// Define your query
$query = '{ getProducts { product_id product_name product_price } }';

try {
    // Execute the query
    $result = GraphQL::executeQuery($schema, $query);
    $output = $result->toArray();

    // Print the result
    echo '<pre>';
    print_r($output);
    echo '</pre>';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
