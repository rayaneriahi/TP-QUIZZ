<?php

session_start();

if (!empty($_SESSION["userName"])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Quizz</title>
</head>
<body class="h-screen flex flex-col bg-red-300">

<!-- <img src="../images/paysage.jpg" class=" absolute h-full w-full z-0"> -->

<header class=" flex flex-row justify-between py-3 z-10 pt-10">

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

    echo "<span>Best score : ".$user["max_score"]."</span>";

?>
    </div>

        <a href="http://tp-quizz.test/quizz/user-list.php"><button>Users</button></a>

        <a href="http://tp-quizz.test/authentification/log-in.php"> <button class="hover:text-gray-400">Log out</button> </a>

    </div>

</header>

<div id="body">

    <div>

        <h1 class=" text-5xl font-semibold text-blue-800">Start new quizz ?</h1>

        <button id="btnStart" class=" text-3xl px-10 border-spacing-12 border-4 border-gray-400 rounded-2xl font-semibold shadow-xl py-1 h-16 w-60 hover:text-blue-800 hover:border-blue-800">Start</button>

    </div>

</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="quizz.js"></script>
</html>

<?php

} else {
    header("Location: http://tp-quizz.test/authentification/sign-in.php");
}

?>