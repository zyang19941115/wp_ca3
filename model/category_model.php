<?php
$table_name = 'categories';

function get_categories() {
    global $db;
    global $table_name;
    $query = "SELECT * FROM $table_name ORDER BY categoryID DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}

function get_latest_category_id() {
    global $db;
    $query = "SELECT category_id FROM categories ORDER BY category_id DESC LIMIT 1";
    $statement = $db->prepare($query);
    $statement->execute();
    $category_id = $statement->fetch();
    return $category_id;
}

function get_category_name($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    $category_name = $category['categoryName'];
    return $category_name;
}

function add_category($name) {
    global $db;
    $query = 'INSERT INTO categories (categoryName)
              VALUES (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
?>