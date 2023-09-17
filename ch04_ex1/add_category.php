<?php
require_once('database.php');

$categoryName = filter_input(INPUT_POST, 'categoryName');

if ($categoryName) {
    $query = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryName', $categoryName);
    $statement->execute();
    $statement->closeCursor();
}

header("Location: category_list.php");
?>