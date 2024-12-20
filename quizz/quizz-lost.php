<?php

    session_start();

    try {
        $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
    } catch(Exception) {
        die;
    }

    $sqlRequest2 = $db->prepare("SELECT * FROM user WHERE name = :name");
    $sqlRequest2->execute([
        "name" => $_SESSION["userName"],
    ]);
    $user = $sqlRequest2->fetch();


    // Sélcetionner les question répondues par l'utilisateur, et le thème associé aà chaque question
    $sqlRequest3 = $db->prepare("SELECT uq.is_correct, q.theme from user_question uq LEFT JOIN question q ON uq.question_id = q.id WHERE user_id = :user_id AND quizz_number = :quizz_number");
    $sqlRequest3->execute([
        "user_id" => $user["id"],
        "quizz_number" => $_SESSION["quizzNumber"],
    ]);
    $answers = $sqlRequest3->fetchAll();

 

    echo json_encode([
        "answers" => $answers,
        "current_score" => $user["current_score"]
    ]);


?>