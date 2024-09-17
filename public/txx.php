<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/GraphQL/Schema.php';

use GraphQL\GraphQL;

$schema = require __DIR__ . '/../src/GraphQL/Schema.php';

$query = '
{
  getProducts {
    product_id
    product_name
    product_description
    category
    brand
    product_price
    inStock
    attribute_1
    attribute_2
    attribute_3
    image_1
    image_2
    image_3
    image_4
    image_5
    image_6
    image_7
  }
}
';

try {
    $result = GraphQL::executeQuery($schema, $query);
    $output = $result->toArray();
    echo json_encode($output, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo 'GraphQL Query Error: ' . $e->getMessage();
}
