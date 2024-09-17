<?php
$host = 'localhost';
$dbname = 'e_commerce';
$user = 'root'; // Adjust if you use a different username
$password = ''; // Adjust if you use a different password

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute a query to fetch all products
    $stmt = $pdo->query("SELECT * FROM products");
    
    // Fetch all products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        echo "Database connection successful. All products:\n";
        print_r($products);
    } else {
        echo "No products found.";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
