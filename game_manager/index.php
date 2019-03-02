<?php
require('../model/database.php');
require('../model/game_model.php');
require('../model/category_model.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_games';
    }
}

switch ($action) {
    case 'list_games':
        display_game_list();
        break;
    case 'show_edit_form':
        show_edit_form();
        break;
    case 'update_game':
        action_update_game();
        break;
    case 'delete_game':
        action_delete_game();
        break;
    case 'show_add_form':
        show_add_form();
        break;
    case 'add_game':
        action_add_game();
        break;
    case 'list_categories':
        list_categories();
        break;
    case 'delete_category':
        action_delete_category();
        break;
}

function display_game_list() {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    // Get game and category data
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $games = get_games_by_category($category_id);

    // Display the game list
    include('game_list.php');
}

function show_edit_form() {
    $game_id = filter_input(INPUT_POST, 'game_id',
        FILTER_VALIDATE_INT);
    if ($game_id == NULL || $game_id == FALSE) {
        $error = "Missing or incorrect game id.";
        include('../errors/error.php');
    } else {
        $game = get_game($game_id);
        include('game_edit.php');
    }
}

function action_update_game() {
    $game_id = filter_input(INPUT_POST, 'game_id',
        FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate the inputs
    if ($game_id == NULL || $game_id == FALSE || $category_id == NULL ||
        $category_id == FALSE || $code == NULL || $name == NULL ||
        $price == NULL || $price == FALSE) {
        $error = "Invalid game data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_game($game_id, $category_id, $code, $name, $price);

        // Display the game List page for the current category
        header("Location: .?category_id=$category_id");
    }
}

function action_delete_game() {
    $game_id = filter_input(INPUT_POST, 'game_id',
        FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id',
        FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE ||
        $game_id == NULL || $game_id == FALSE) {
        $error = "Missing or incorrect game id or category id.";
        include('../errors/error.php');
    } else {
        delete_game($game_id);
        header("Location: .?category_id=$category_id");
    }
}

function show_add_form() {
    $categories = get_categories();
    include('game_add.php');
}

function action_add_game() {
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