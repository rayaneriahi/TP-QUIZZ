<?php

session_start();

    try {
        $db = new PDO('mysql:host=localhost; dbname=tp-quizz', 'root', '');
    } catch(Exception) {
        die;
    }

    $sqlRequest = $db->prepare("SELECT * FROM users WHERE name = :name");
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
