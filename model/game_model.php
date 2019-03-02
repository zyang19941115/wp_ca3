<?php
function get_games() {
    global $db;
    $query = 'SELECT * FROM games WHERE is_deleted = 0
              ORDER BY gameID';
    $statement = $db->prepare($query);
    $statement->execute();
    $games = $statement->fetchAll();
    $statement->closeCursor();
    return $games;
}

function get_games_by_category($category_id) {
    global $db;
    $query = 'SELECT * FROM games
              WHERE games.categoryID = :category_id AND is_deleted = 0
              ORDER BY gameID';
    $statement = $db->prepare($query);
    $statement->bindValue(":category_id", $category_id);
    $statement->execute();
    $games = $statement->fetchAll();
    $statement->closeCursor();
    return $games;
}

function get_game($game_id) {
    global $db;
    $query = 'SELECT * FROM games
              WHERE gameID = :game_id AND is_deleted = 0';
    $statement = $db->prepare($query);
    $statement->bindValue(":game_id", $game_id);
    $statement->execute();
    $game = $statement->fetch();
    $statement->closeCursor();
    return $game;
}

/**
 * @param $game_id
 * use soft delete
 */
function delete_game($game_id) {
    global $db;
    $query = "UPDATE games 
              set is_deleted = 1 
              WHERE gameID = :game_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_game($category_id, $code, $name, $price) {
    global $db;
    $query = 'INSERT INTO games
                 (categoryID, gameCode, gameName, listPrice)
              VALUES
                 (:category_id, :code, :name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}

function update_game($game_id, $category_id, $code, $name, $price) {
    global $db;
    $query = 'UPDATE games
              SET categoryID = :category_id,
                  gameCode = :code,
                  gameName = :name,
                  listPrice = :price
               WHERE gameID = :game_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':game_id', $game_id);
    $statement->execute();
    $statement->closeCursor();
}
?>