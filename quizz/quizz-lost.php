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

    $_SESSION["currentScore"] = $user["max_score"];

?>

<div class="items-center flex flex-col justify-center h-1/2 w-5/12 space-y-20 rounded-2xl bg-white">

    <div class="flex flex-col items-center justify-center space-y-20">

        <h1 class="text-5xl font-semibold text-blue-800">You lost ...</h1>

        <button class="text-3xl px-10 border-spacing-12 border-4 border-gray-400 rounded-2xl font-semibold shadow-xl py-1 h-16 w-60 hover:text-blue-800 hover:border-blue-800" id="btnRestart">Restart</button>

    </div>

</div>