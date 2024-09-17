<?php

// Sample GraphQL query string
$query = '
{
    getProducts {
        product_id
        product_name
    }
}';

// Simulate sending this query as a POST request
$ch = curl_init('http://localhost/scandiweb-ecommerce/public/index.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['query' => $query]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

// Output the response
echo $response;
