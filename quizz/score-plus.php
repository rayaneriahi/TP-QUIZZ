<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$sqlRequest2 = $db->prepare("SELECT * FROM users WHERE name = :name");
$sqlRequest2->execute(["name" => $_SESSION["userName"]]);
$user = $sqlRequest2->fetch();

$scorePlus = $user["current_score"] + 1;

if (is_null($user["current_score"])) {

    $userRequest1 = $db->prepare("UPDATE users SET current_score = :current_score, max_score = :max_score WHERE name = :name");
    $userRequest1->execute([
        "current_score"=> 1,
        "max_score"=> 1,
        "name"=> $_SESSION["userName"]
    ]);

} else {

    $userRequest2 = $db->prepare("UPDATE users SET current_score = :current_score WHERE name = :name");
    $userRequest2->execute([
        "current_score"=> $user["current_score"] + 1,
        "name"=> $_SESSION["userName"],
    ]);

    if ($user["current_score"] >= $user["max_score"]) {

        $userRequest2 = $db->prepare("UPDATE users SET max_score = :max_score WHERE name = :name");
        $userRequest2->execute([
            "max_score"=> $user["current_score"] + 1,
            "name"=> $_SESSION["userName"],
        ]);

    }

}

?>