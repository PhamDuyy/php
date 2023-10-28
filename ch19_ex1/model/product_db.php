<?php
function get_products_by_category($category_id) {
    global $db;
    $category_id_esc = $db->escape_string($category_id);
    $query = "SELECT * FROM products WHERE categoryID = '$category_id_esc'";
    $result = $db->query($query);
    if ($result == false) {
        display_db_error($db->error);
    }
    $products = array();
    for ($i = 0; $i < $result->num_rows; $i++) {
        $product = $result->fetch_assoc();
        $products[] = $product;
    }
    $result->free();
    return $products;
}

function get_product_by_name($name) {
    global $db;
    $name_esc = $db->escape_string($name);
    $query = "SELECT * FROM products WHERE productName = '$name_esc'";
    $result = $db->query($query);
    if ($result == false) {
        display_db_error($db->error);
    }
    return $result->fetch_assoc();
}

function add_product($category_id, $code, $name, $description, $price, $discount_percent) {
    global $db;
    $query = 'INSERT INTO products
                 (categoryID, productCode, productName, description,
                  listPrice, discountPercent, dateAdded)
              VALUES
                  (?, ?, ?, ?, ?, ?, NOW())';
    $statement = $db->prepare($query);
    if ($statement == false) {
        display_db_error($db->error);
    }
    $statement->bind_param("isssdd", $category_id, $code, $name, $description, $price, $discount_percent);
    $success = $statement->execute();
    if ($success) {
        $product_id = $db->insert_id;
        $statement->close();
        return $product_id;
    } else {
        display_db_error($db->error);
    }
}

function delete_product($product_id) {
    global $db;
    $query = "DELETE FROM products
              WHERE productID = ?";
    $statement = $db->prepare($query);
    if ($statement == false) {
        display_db_error($db->error);
    }
    $statement->bind_param("i", $product_id);
    $success = $statement->execute();
    if ($success) {
        $count = $db->affected_rows;
        $statement->close();
        return $count;
    } else {
        display_db_error($db->error);
    }
}
?>
