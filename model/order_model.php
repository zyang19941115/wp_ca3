<?php
function add_order($game_id) {
    global $db;
    /**
     * Temporarily set member id as 1.
     */
    $member_id = 1;
    $query = 'INSERT INTO orders
                 (game_id, member_id)
              VALUES
                 (:game_id, :member_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_order_number_by_game_id($game_id) {
    global $db;
    $query = "select count(game_id) as number from orders where game_id = :game_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":game_id", $game_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['number'];
}