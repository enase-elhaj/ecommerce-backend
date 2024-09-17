<?php

// Define the GraphQL endpoint URL
$endpoint = 'http://localhost/scandiweb-ecommerce/public/index.php'; // Update this with your actual endpoint URL

// Define the GraphQL mutation query
$mutation = <<<GRAPHQL
mutation {
  placeOrder(
    product_id: "123test",
    attributes: "{\"color\": \"red\", \"size\": \"M\"}",
    product_price: "29.99",
    quantity: 2
  ) {
    order_id
    product_id
    attributes
    product_price
    quantity
  }
}
GRAPHQL;

// Initialize cURL
$ch = curl_init($endpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'query' => $mutation
]));

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Output the response
    echo 'Response: ' . $response;
}

// Close cURL
curl_close($ch);
