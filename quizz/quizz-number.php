<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$request = $db ->prepare('SELECT * FROM user_question');
$request -> execute();
$result = $request -> fetchAll();

$request = $db ->prepare('SELECT * FROM user LIMIT 1');
$request -> execute();
$user = $request -> fetch();

$request = $db ->prepare('SELECT * FROM question LIMIT 1');
$request -> execute();
$question = $request -> fetch();

if (empty($result)) {

    $request = $db -> prepare('INSERT INTO user_question (user_id, question_id, is_correct) VALUES (:user_id, :question_id, :is_correct)');
    $request -> execute([
        "user_id" => $user["id"],
        "question_id" => $question["id"],
        "is_correct" => 1,
    ]);

}

$request = $db -> prepare('SELECT quizz_number FROM user_question ORDER BY quizz_number DESC LIMIT 1');
$request -> execute();
$user_question = $request -> fetch();

$_SESSION["quizzNumber"] = $user_question["quizz_number"] + 1;

?>