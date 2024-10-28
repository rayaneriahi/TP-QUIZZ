<?php

session_start();

try {
    $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
} catch(Exception) {
    die;
}

$sqlRequest2 = $db->prepare("SELECT id FROM questions ORDER BY id DESC LIMIT 1");
$sqlRequest2->execute();
$id = $sqlRequest2->fetch();

$sqlRequest1 = $db->prepare("SELECT * FROM `questions` WHERE id = :number");
$sqlRequest1->execute(["number" => $rand = rand(1, $id["id"])]);
$question = $sqlRequest1->fetch();

$sqlRequest3 = $db->prepare("SELECT * FROM answer WHERE question_id = :question_id");
$sqlRequest3->execute(["question_id" => $question["id"]]);
$answers = $sqlRequest3->fetchAll();

$sqlRequest3 = $db->prepare("SELECT * FROM users WHERE name = :name");
$sqlRequest3->execute(["name" => $_SESSION["userName"]]);
$user = $sqlRequest3->fetch();

?>

<div class="space-y-10 pt-5">

    <div class="px-10 flex flex-row justify-between">

        <p class="text-2xl">Theme : <?php echo $question["theme"];?></p>
        
        <div>

        <p id="timer" class="text-xl">(30) s</p>
        
        <?php echo "<p id=\"score\" class=\"text-xl\">Score (" . $user["current_score"] . ")</p>" ?>

        </div>

    </div>

    <div class="place-self-center">

            <h1 class="text-3xl"><?php echo $question["text"];?></h1>
            
    </div>


    <div class="place-self-center space-y-5">

    <p class="text-2xl"><?php echo "(1) " . $answers[0]["text"];?></p>

    <p class="text-2xl"><?php echo "(2) " . $answers[1]["text"];?></p>

    <p class="text-2xl"><?php echo "(3) " . $answers[2]["text"];?></p>

    </div>

    <div class="place-self-center space-x-4">

        <button class="btnsAnswer text-xl border border-black px-2 rounded-lg size-10" id="<?php echo $answers[0]["is_correct"];?>">1</button>

        <button class="btnsAnswer text-xl border border-black px-2 rounded-lg size-10" id="<?php echo $answers[1]["is_correct"];?>">2</button>

        <button class="btnsAnswer text-xl border border-black px-2 rounded-lg size-10" id="<?php echo $answers[2]["is_correct"];?>">3</button>

    </div>

</div>