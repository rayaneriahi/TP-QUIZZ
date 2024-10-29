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

?>

    <div class=" pl-10 text-3xl font-semibold text-white space-x-10">
<?php

    echo "<span>".$user["name"]."</span>";

    echo "<span>Best score : ".$user["max_score"]."</span>";

?>
    </div>

    <div class=" flex flex-row text-white font-semibold items-center pr-10 text-3xl space-x-10">
        
        <button id="btnUsers" class=" hover:text-gray-400">Users</button>

        <a href="http://tp-quizz.test/authentification/log-in.php"> <button class="hover:text-gray-400">Log out</button> </a>

    </div>