<?php

session_start();

    try {
        $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
    } catch(Exception) {
        die;
    }

    $sqlRequest = $db->prepare("SELECT * FROM user WHERE name = :name");
    $sqlRequest->execute(["name" => $_SESSION["userName"]]);
    $user = $sqlRequest->fetch();  

    $sqlRequest = $db->prepare("SELECT * FROM user");
    $sqlRequest->execute();
    $users = $sqlRequest->fetchall();  
?>


<img src="../images/paysage.jpg" class=" absolute h-full w-full z-0">

<header class="  flex flex-row justify-between py-3 z-10 pt-10">

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

    <div class=" pl-10 text-3xl font-semibold text-white space-x-10">
<?php

    echo "<span>".$user["name"]."</span>";

    echo "<span>Best score (".$user["max_score"].")</span>";

?>
    </div>

    <div class=" flex flex-row text-white font-semibold items-center pr-10 text-3xl space-x-10">
        
        <button id="btnQuizz" class=" hover:text-gray-400">Quizz</button>

        <a href="http://tp-quizz.test/authentification/log-in.php"> <button class=" hover:text-gray-400">Log out</button> </a>

    </div>

</header>

<div class="grow flex flex-row z-10 justify-center items-center space-x-20">

    <div class="bg-white h-2/3 w-1/3 space-y-10 rounded-2xl over">

        <h1 class=" text-blue-800 text-4xl font-semibold place-self-center sticky">Users list</h1>

        <?php foreach ($users as $value) {
                echo "<p class=\"text-2xl pl-5\">".$value["name"]."</p>";
        } ?>

    </div>

    <div class="bg-white h-2/3 w-1/3 space-y-10 rounded-2xl">

        <h1 class=" text-blue-800 text-4xl font-semibold place-self-center">Leader board</h1>

    </div>

</div>