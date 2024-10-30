<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$request = $db->prepare('SELECT * FROM user WHERE name = :name');
$request->execute(["name" => $_SESSION["userName"]]);
$user = $request->fetch();
echo $user["name"];

if (isset($_GET["answer"]) && $_GET["answer"] == "true") {

    $request = $db-> prepare('INSERT INTO user_question (user_id, question_id, is_correct, quizz_number) VALUES (:user_id, :question_id, :is_correct, :quizz_number)');
    $request->execute([
        "user_id" => $user["id"],
        "question_id" => $_GET["question-id"],
        "is_correct" => 1,
        "quizz_number"=> $_SESSION["quizzNumber"],
    ]);

} elseif (isset($_GET["answer"])) {

    $request = $db-> prepare('INSERT INTO user_question (user_id, question_id, is_correct, quizz_number) VALUES (:user_id, :question_id, :is_correct, :quizz_number)');
    $request->execute([
        "user_id" => $user["id"],
        "question_id" => $_GET["question-id"],
        "is_correct" => 0,
        "quizz_number"=> $_SESSION["quizzNumber"],
    ]);

}

?>