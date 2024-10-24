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

    if (empty($user)) {

        header("Location: http://tp-quizz.test/authentification/log-in.php?user-name");
        die;

    } else {

    $_SESSION["connect"] = true;

    header("Location: http://tp-quizz.test/index.php?log-in");

    }

} else {echo "error";}

?>