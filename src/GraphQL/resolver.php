<?php
namespace App\GraphQL;

require_once __DIR__ . '/../../database.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../Models/Order.php';

// function createProductResolver($root, $args) {
//     $database = new \Database();
//     $db = $database->getConnection();

//     $query = "INSERT INTO products (product_id, product_name, product_description, category, brand, product_price, 
//     inStock,attribute_1, attribute_2, attribute_3, image_1,image_2, image_3,image_4,image_5,image_6, image_7)
//               VALUES (:product_id, :product_name, :product_description, :categoryid, :brand, :product_price, :inStock,
//               :attribute_1, :attribute_2, :attribute_3, :image_1,:image_2, :image_3,:image_4,:image_5,:image_6, :image_7 )";

//     $stmt = $db->prepare($query);
//     $stmt->bindParam(':product_id', $args['product_id']);
//     $stmt->bindParam(':product_name', $args['product_name']);
//     $stmt->bindParam(':product_description', $args['product_description']);
//     $stmt->bindParam(':category', $args['category']);
//     $stmt->bindParam(':brand', $args['brand']);
//     $stmt->bindParam(':product_price', $args['product_price']);
//     $stmt->bindParam(':inStock', $args['inStock']);
//     $stmt->bindParam(':attribute_1', $args['attribute_1']);
//     $stmt->bindParam(':attribute_2', $args['attribute_2']);
//     $stmt->bindParam(':attribute_3', $args['attribute_3']);
//     $stmt->bindParam(':image_1', $args['image_1']);
//     $stmt->bindParam(':image_2', $args['image_2']);
//     $stmt->bindParam(':image_3', $args['image_3']);
//     $stmt->bindParam(':image_4', $args['image_4']);
//     $stmt->bindParam(':image_5', $args['image_5']);
//     $stmt->bindParam(':image_6', $args['image_6']);
//     $stmt->bindParam(':image_7', $args['image_7']);
//     // $stmt->bindParam(':pricex', $args['pricex']); 

//     if ($stmt->execute()) {
//         return new \App\Models\Product(
//             $args['product_id'],
//             $args['product_name'],
//             $args['inStock'],
//             $args['product_description'],
//             $args['category'], 
//             $args['product_price'],
//             $args['brand'],
//             $args['inStock'],
//             $args['attribute_1'],
//             $args['attribute_2'],
//             $args['attribute_3'],
//             $args['image_1'],
//             $args['image_2'],
//             $args['image_3'],
//             $args['image_4'],
//             $args['image_5'],
//             $args['image_6'],
//             $args['image_7'],
//             // $args['pricex'],
//         );
//     } else {
//         $errorInfo = $stmt->errorInfo();
//         throw new \Exception('Error executing query: ' . $errorInfo[2]);
//     }
// }


function getProductsResolver($root, $args, $context, $info) {
    try {
        $database = new \Database();
        $db = $database->getConnection();
        
        $query = "SELECT product_id, product_name, product_description, category, brand, product_price, 
         inStock, attribute_1, attribute_2, attribute_3, image_1, image_2, image_3, image_4,image_5, 
        image_6,image_7 FROM products";
        $stmt = $db->query($query);
        
        if (!$stmt) {
            error_log("Database query failed");
            return [];
        }
        
        $products = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $row['image_1'] = trim($row['image_1']);
            $row['image_2'] = trim($row['image_2']);
            $row['image_3'] = trim($row['image_3']);
            $row['image_4'] = trim($row['image_4']);
            $row['image_5'] = trim($row['image_5']);
            $row['image_6'] = trim($row['image_6']);
            $row['image_7'] = trim($row['image_7']);

            $products[] = $row;
        }
        
        return $products;
    } catch (\PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

function getItemsResolver($root, $args, $context, $info) {
    try {
        // Initialize database connection
        $database = new \Database();
        $db = $database->getConnection();
        
        // SQL query to fetch items
        $query = "SELECT item_id, attribute_name, product_id, display_value, valuex FROM items";
        $stmt = $db->query($query);
        
        if (!$stmt) {
            error_log("Database query failed");
            return [];
        }

        // Fetch items from the database and store them in an array
        $items = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            
            $items[] = $row; // Append item row to the items array
        }
        
        return $items; // Return the array of items
    } catch (\PDOException $e) {
        // Log any database errors
        error_log("Database error: " . $e->getMessage());
        return [];
    }
}

function placeOrderResolver($root, $args) {
    try {
        // Create a database connection
        $database = new \Database();
        $db = $database->getConnection();

        // Prepare the SQL query for inserting an order without 'order_id'
        $query = "INSERT INTO orders (product_id, attributes, product_price, quantity)
                  VALUES (:product_id, :attributes, :product_price, :quantity)";

        $stmt = $db->prepare($query);

        // Bind the parameters from the GraphQL args
        $stmt->bindParam(':product_id', $args['product_id']);
        $stmt->bindParam(':attributes', $args['attributes']);
        $stmt->bindParam(':product_price', $args['product_price']);
        $stmt->bindParam(':quantity', $args['quantity']);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the last inserted order ID (auto-incremented value)
            $lastInsertId = $db->lastInsertId();

            // Return the order details, including the auto-generated order_id
            return new \App\Models\Order(
                $lastInsertId,
                $args['product_id'],
                $args['attributes'],
                $args['product_price'],
                $args['quantity']
            );
        } else {
            // If execution fails, throw an exception
            $errorInfo = $stmt->errorInfo();
            error_log('Error executing order query: ' . $errorInfo[2]);
            throw new \Exception('Error executing order query: ' . $errorInfo[2]);
        }
    } catch (\PDOException $e) {
        // Log any database error
        error_log("Database error: " . $e->getMessage());
        return null;
    }
}


