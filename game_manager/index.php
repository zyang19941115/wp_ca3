<?php
require('../model/database.php');
require('../model/game_model.php');
require('../model/category_model.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        display_product_list();
        break;
    case 'show_edit_form':
        show_edit_form();
        break;
    case 'update_product':
        action_update_product();
        break;
    case 'delete_product':
        action_delete_product();
        break;
    case 'show_add_form':
        show_add_form();
        break;
    case 'add_product':
        action_add_product();
        break;
    case 'list_categories':
        list_categories();
        break;
    case 'delete_category':
        action_delete_category();
        break;
}

function display_product_list() {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    // Get product and category data
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_games_by_category($category_id);

    // Display the product list
    include('product_list.php');
}

function show_edit_form() {
    $product_id = filter_input(INPUT_POST, 'product_id',
        FILTER_VALIDATE_INT);
    if ($product_id == NULL || $product_id == FALSE) {
        $error = "Missing or incorrect product id.";
        include('../errors/error.php');
    } else {
        $game = get_game($product_id);
        include('product_edit.php');
    }
}

function action_update_product() {
    $product_id = filter_input(INPUT_POST, 'product_id',
        FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate the inputs
    if ($product_id == NULL || $product_id == FALSE || $category_id == NULL ||
        $category_id == FALSE || $code == NULL || $name == NULL ||
        $price == NULL || $price == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_game($product_id, $category_id, $code, $name, $price);

        // Display the Product List page for the current category
        header("Location: .?category_id=$category_id");
    }
}

function action_delete_product() {
    $product_id = filter_input(INPUT_POST, 'product_id',
        FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE ||
        $product_id == NULL || $product_id == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');
    } else {
        delete_game($product_id);
        header("Location: .?category_id=$category_id");
    }
}

function show_add_form() {
    $categories = get_categories();
    include('product_add.php');
}

function action_add_product() {
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if ($category_id == NULL || $category_id == FALSE || $code == NULL ||
        $name == NULL || $price == NULL || $price == FALSE) {
        $error = "Invalid game data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_game($category_id, $code, $name, $price);
        header("Location: .?category_id=$category_id");
    }
}

function list_categories() {
    $categories = get_categories();
    include('category_list.php');
}

function action_add_category() {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid category name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_category($name);
        //return the Category List page
        header('Location: .?action=list_categories');
    }
}

function action_delete_category() {
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    delete_category($category_id);
    // return the Category List page
    header('Location: .?action=list_categories');
}
?>