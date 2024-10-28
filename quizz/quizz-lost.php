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

<div class=" flex flex-col space-y-28">

<p class="text-xl flex flex-row-reverse pr-10 pt-5"><?php echo "Score (" . $user["current_score"] . ")" ?></p>


<div class="flex flex-col items-center justify-center space-y-20">

    <h1 class="text-5xl">You lost ...</h1>

    <button class=" text-2xl px-10 border border-black rounded-xl shadow-xl py-1" id="btnRestart">Restart</button>

</div>

</div>