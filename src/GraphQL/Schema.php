<?php
namespace App\GraphQL;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;


require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/resolver.php'; // Include resolver

$productType = new ObjectType([
    'name' => 'Product',
    'fields' => [
        'product_id' => ['type' => Type::string()],
        'product_name' => ['type' => Type::string()],
        'product_description' => ['type' => Type::string()],
        'category' => ['type' => Type::string()],
        'brand' => ['type' => Type::string()],
        'product_price' => ['type' => Type::string()],
        'inStock' => ['type' => Type::boolean()],
        'attribute_1' => ['type' => Type::string()],
        'attribute_2' => ['type' => Type::string()],
        'attribute_3' => ['type' => Type::string()],
        'image_1' => ['type' => Type::string()],
        'image_2' => ['type' => Type::string()],
        'image_3' => ['type' => Type::string()],
        'image_4' => ['type' => Type::string()],
        'image_5' => ['type' => Type::string()],
        'image_6' => ['type' => Type::string()],
        'image_7' => ['type' => Type::string()],
    ]
]);

$itemType = new ObjectType([
    'name' => 'Item',
    'fields' => [
        'item_id' => ['type' => Type::int()],
        'attribute_name' => ['type' => Type::string()],
        'product_id' => ['type' => Type::string()],
        'display_value' => ['type' => Type::string()],
        'valuex' => ['type' => Type::string()],
    ]
]);

$orderType = new ObjectType([
    'name' => 'Order',
    'fields' => [
        'order_id' => ['type' => Type::int()],
        'product_id' => ['type' => Type::string()],
        'attributes' => ['type' => Type::string()],
        'product_price' => ['type' => Type::string()],
        'quantity' => ['type' => Type::int()],
    ]
]);

$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'getProducts' => [
            'type' => Type::listOf($productType),
            'resolve' => function($root, $args, $context, $info) {
                return getProductsResolver($root, $args, $context, $info);
            },
        ],
        'getItems' => [
            'type' => Type::listOf($itemType),
            'resolve' => function($root, $args, $context, $info) {
                return getItemsResolver($root, $args, $context, $info);
            },
        ],
    ],
]);

$mutationType = new ObjectType([
    'name' => 'Mutation',
    'fields' => [
        // 'createProduct' => [
        //     'type' => $productType,
        //     'args' => [
        //         'product_id' => Type::nonNull(Type::string()),
        //         'product_name' => Type::nonNull(Type::string()),
        //         'product_description' => Type::string(),
        //         'category' => Type::string(),
        //         'brand' => Type::string(),
        //         'product_price' => Type::nonNull(Type::string()),
        //         'inStock' => Type::nonNull(Type::boolean()),
        //         'attribute_1' => Type::string(),
        //         'attribute_2' => Type::string(),
        //         'attribute_3' => Type::string(),
        //         'image_1' => Type::string(),
        //         'image_2' => Type::string(),
        //         'image_3' => Type::string(),
        //         'image_4' => Type::string(),
        //         'image_5' => Type::string(),
        //         'image_6' => Type::string(),
        //         'image_7' => Type::string(),
        //     ],
        //     'resolve' => function($root, $args, $context, $info) {
        //         return createProductResolver($root, $args);
        //     }
        // ],
        'placeOrder' => [
            'type' => $orderType,
            'args' => [
                'product_id' => Type::string(),  // non-nullable
                'attributes' => Type::string(),  //non-nullable
                'product_price' => Type::string(), //non-nullable
                'quantity' => Type::int(),  
            ],
            // 'resolve' => function($root, $args, $context, $info) {
            //     return placeOrderResolver($root, $args);
            // }
            'resolve' => function($root, $args, $context, $info) {
                // handle empty attributes properly in the resolver
                if (!isset($args['attributes']) || $args['attributes'] === '') {
                    $args['attributes'] = '{}';  // Set default if attributes not provided
                }
                return placeOrderResolver($root, $args);
            }
        ],
    ],
]);

$schema = new Schema([
    'query' => $queryType,
    'mutation' => $mutationType,
]);

return $schema;



