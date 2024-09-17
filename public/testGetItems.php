<?php
use GraphQL\GraphQL;
require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/../src/GraphQL/resolver.php';
require_once __DIR__ . '/../src/GraphQL/Schema.php';



$url = 'http://localhost/scandiweb-ecommerce/public/index.php';

$query = <<<'GRAPHQL'
query {
    getItems {
    item_id
    attribute_name
    product_id
    display_value
    valuex   
  }

}
GRAPHQL;


$data = ['query' => $query];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    echo "Response:\n";
    print_r($responseData);
}

curl_close($ch);
