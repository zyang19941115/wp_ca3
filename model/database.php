<?php
    $dsn = 'mysql:host=localhost;dbname=YangZheng_my_game_shop';
    $username = 'root';
    $password = 'password';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>