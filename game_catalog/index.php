<?php
require('../model/database.php');
require('../model/game_model.php');
require('../model/category_model.php');
require('../model/order_model.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_games';
    }
}

switch ($action) {
    case 'view_game':
        display_game();
        break;
    case 'list_games':
        display_game_list();
        break;
    case 'bug_game':
        action_add_order();
        break;
}

function display_game() {
    $game_id = filter_input(INPUT_GET, 'game_id',
        FILTER_VALIDATE_INT);
    if ($game_id == NULL || $game_id == FALSE) {
        $error = 'Missing or incorrect game id.';
        include('../errors/error.php');
    } else {
        $categories = get_categories();
        $game = get_game($game_id);

        // Get game data
        $code = $game['gameCode'];
        $name = $game['gameName'];
        $list_price = $game['listPrice'];

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

function display_game_list() {
    $category_id = filter_input(INPUT_GET, 'category_id',
        FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
    $categories = get_categories();
    $category_name = get_category_name($category_id);
    $games = get_games_by_category($category_id);
    include('game_list.php');
}

function action_add_order() {
    $game_id = filter_input(INPUT_POST, 'game_id', FILTER_VALIDATE_INT);
    if ($game_id == NULL || $game_id == FALSE) {
        $error = 'Missing or incorrect game id.';
        include('../errors/error.php');
    } else {
        add_order($game_id);
        header('Location: .?action=list_games');
    }
}
?>



