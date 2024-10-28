<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$userRequest = $db->prepare("UPDATE users SET current_score = :current_score WHERE name = :name");
$userRequest->execute([
    "current_score"=> 0,
    "name"=> $_SESSION["userName"],
]);

?>