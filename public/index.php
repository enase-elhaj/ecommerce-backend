<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/GraphQL/Schema.php';

use GraphQL\GraphQL;

// Set CORS headers
header('Access-Control-Allow-Origin: *'); // Allow all origins, or specify your frontend origin
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit; // Stop execution for preflight requests
}

// Load the GraphQL schema
$schema = require __DIR__ . '/../src/GraphQL/Schema.php';


// Retrieve raw input
$rawInput = file_get_contents('php://input');

// Decode the JSON input
$input = json_decode($rawInput, true);

// Retrieve the query from the input
$query = $input['query'] ?? null;

// if ($query === null) {
//     echo json_encode(['error' => 'No query provided']);
//     exit;
// }
if ($query === null) {
    echo json_encode(['error' => 'No query provided', 'input' => $input, 'rawInput' => $rawInput]);
    exit;
}

// Execute the GraphQL query
$result = GraphQL::executeQuery($schema, $query);
$output = $result->toArray();

// Set the content type to JSON and return the output
header('Content-Type: application/json');
echo json_encode($output);


