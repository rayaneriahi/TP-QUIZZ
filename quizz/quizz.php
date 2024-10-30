<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$sqlRequest2 = $db->prepare("SELECT id FROM question ORDER BY id DESC LIMIT 1");
$sqlRequest2->execute();
$id = $sqlRequest2->fetch();

$sqlRequest1 = $db->prepare("SELECT * FROM `question` WHERE id = :number");
$sqlRequest1->execute(["number" => $rand = rand(1, $id["id"])]);
$question = $sqlRequest1->fetch();

$sqlRequest3 = $db->prepare("SELECT * FROM answer WHERE question_id = :question_id");
$sqlRequest3->execute(["question_id" => $question["id"]]);
$answers = $sqlRequest3->fetchAll();

$sqlRequest3 = $db->prepare("SELECT * FROM user WHERE name = :name");
$sqlRequest3->execute(["name" => $_SESSION["userName"]]);
$user = $sqlRequest3->fetch();

echo json_encode([
    "questionTheme" => $question["theme"],
    "question" => $question["text"],
    "currentScore" => $user["current_score"],
    "question1IsCorrect" => $answers[0]["is_correct"],
    "question2IsCorrect" => $answers[1]["is_correct"],
    "question3IsCorrect" => $answers[2]["is_correct"],
    "question1"=> $answers[0]["text"],
    "question2"=> $answers[1]["text"],
    "question3"=> $answers[2]["text"],
])


?>