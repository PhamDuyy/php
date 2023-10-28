<?php
require('util/main.php');
require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/
$cat_id = 1;  // Giả sử ID của danh mục Guitars là 1
$products = get_products_by_category($cat_id);

/***************************************
 * Delete a product
 ****************************************/
$product_name = 'Fender Telecaster';
$product = get_product_by_name($product_name);
if ($product) {
    $rows_deleted = delete_product($product['productID']);
    if ($rows_deleted > 0) {
        $delete_message = "$rows_deleted row was deleted.";
    } else {
        $delete_message = "No rows were deleted.";
    }
} else {
    $delete_message = "Product not found.";
}

/***************************************
 * Insert a product
 ****************************************/
$category_id = 1;  // Giả sử ID của danh mục Guitars là 1
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';
$product_id = add_product($category_id, $code, $name, $description, $price, 0);

if ($product_id) {
    $insert_message = "1 row was inserted with ID $product_id.";
} else {
    $insert_message = "No rows were inserted.";
}

include 'home.php';
?>