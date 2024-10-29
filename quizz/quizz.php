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

?>

<div class="space-y-10 pt-10 bg-white w-10/12 rounded-2xl">

    <div class="flex flex-row w-full">

        <p class="text-3xl font-semibold w-1/3 pl-10">Theme : <?php echo $question["theme"];?></p>
        
        <p id="timer" class="text-3xl font-semibold w-1/3 text-center">30 sec</p>


    </div>

    <div class="place-self-center">

            <h1 class="text-4xl font-semibold text-blue-800"><?php echo $question["text"];?></h1>
            
    </div>

    <div class="place-self-center flex flex-col w-full space-y-6">

        <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="<?php echo $answers[0]["is_correct"];?>"> <p class="text-2xl"><?php echo $answers[0]["text"];?></p></button>

        <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="<?php echo $answers[1]["is_correct"];?>"> <p class="text-2xl"><?php echo $answers[1]["text"];?></p></button>

        <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="<?php echo $answers[2]["is_correct"];?>"> <p class="text-2xl"><?php echo $answers[2]["text"];?></p></button>

    </div>

    <p id="score" class="place-self-center pb-10 text-3xl font-semibold"><?php echo "Score : " . $user["current_score"];?></p>

</div>

