<?php
$host = 'localhost';
$dbname = 'e_commerce';
$user = 'root'; // Adjust if you use a different username
$password = ''; // Adjust if you use a different password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test a simple query
    $stmt = $pdo->query("SELECT * FROM products LIMIT 1");
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo "Database connection successful. Sample product:\n";
        print_r($product);
    } else {
        echo "No products found.";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
