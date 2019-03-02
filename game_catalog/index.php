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
    case 'view_product':
        display_product();
        break;
    case 'list_products':
        display_product_list();
}

function display_product() {
    $product_id = filter_input(INPUT_GET, 'product_id',
        FILTER_VALIDATE_INT);
    if ($product_id == NULL || $product_id == FALSE) {
        $error = 'Missing or incorrect product id.';
        include('../errors/error.php');
    } else {
        $categories = get_categories();
        $product = get_game($product_id);

        // Get product data
        $code = $product['gameCode'];
        $name = $product['gameName'];
        $list_price = $product['listPrice'];

        // Calculate discounts 30% off for all web orders
        $discount_percent = 30;
        $discount_amount = round($list_price * ($discount_percent / 100.0), 2);
        $unit_price = $list_price - $discount_amount;

    }
    // Format the calculations
    $discount_amount_f = number_format($discount_amount, 2);
    $unit_price_f = number_format($unit_price, 2);

    // Get image URL and alternate text
    $image_filename = '../images/' . $code . '.png';
    $image_alt = 'Image: ' . $code . '.png';

    include('game_view.php');
}

function display_product_list() {
    $category_id = filter_input(INPUT_GET, 'category_id',
        FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
    $categories = get_categories();
    $category_name = get_category_name($category_id);
    $products = get_games_by_category($category_id);
    include('game_list.php');
}
?>



