<?php

session_start();

?>

<header class=" flex flex-row justify-between border-b-4 border-orange-300 py-3">

<?php

    try {
        $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
    } catch(Exception) {
        die;
    }

    $sqlRequest = $db->prepare("SELECT * FROM user WHERE name = :name");
    $sqlRequest->execute(["name" => $_SESSION["userName"]]);
    $user = $sqlRequest->fetch();  

?>

    <div class=" flex flex-col pl-10 text-2xl space-y-2">
<?php

    echo "<span>".$user["name"]."</span>";

    echo "<span>Best score (".$user["max_score"].")</span>";

?>
    </div>

    <div class=" flex flex-row items-center pr-10 text-2xl space-x-10">
        
        <button id="btnUsers">Users</button>

        <a href="http://tp-quizz.test/authentification/log-in.php"> <button>Log out</button> </a>

    </div>

</header>

<div id="body" class="grow">
     
    <div class="items-center flex flex-col justify-center h-full space-y-20">

    <h1 class=" text-5xl">Start new quizz ?</h1>

    <button id="btnStart" class=" text-2xl px-10 border border-black rounded-xl shadow-xl py-1">Start</button>

    </div>


    <script src="quizz.js"></script>

</div>