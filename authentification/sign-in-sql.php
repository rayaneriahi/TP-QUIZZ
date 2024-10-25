<?php

session_start();

if (!empty($_POST)) {

    try {
        $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
    } catch(Exception) {
        die;
    }

    $userRequest = $db->prepare("SELECT * FROM users WHERE name = :name");
    $userRequest->execute(["name" => $_POST["userName"]]);
    $user = $userRequest->fetch();

    if(empty($user)) {
        
        $userRequest = $db->prepare("INSERT INTO users (name, max_score) VALUES (:name, :max_score)");
        $userRequest->execute([
            "name"=> $_POST["userName"],
            "max_score"=> 0,
        ]);

        $_SESSION["connect"] = true;

        header("Location: http://tp-quizz.test/index.php?sign-in");

        die;

    } else {
        header("Location: http://tp-quizz.test/authentification/sign-in.php?user-name");
        die;
    }

} else {echo "error";}

?>