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

    $sqlRequest2 = $db->prepare("SELECT name, max_score FROM user ORDER BY max_score DESC");
    $sqlRequest2->execute();
    $users = $sqlRequest2->fetchAll();

    $userNames = array_map(function($user) {
        return $user['name'];
    }, $users);

    $maxScores = array_map(function($user) {
        return $user['max_score'];
    }, $users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Quizz</title>
</head>
<body class="h-screen flex flex-col">

    <img src="../images/paysage.jpg" class=" absolute h-full w-full z-0">

    <header class="  flex flex-row justify-between py-3 z-10 pt-10">

        <div class=" pl-10 text-3xl font-semibold text-white space-x-10">

            <span><?php echo $user["name"];?></span>

            <span>Best score (<?php echo $user["max_score"]?>)</span>

        </div>

        <div class=" flex flex-row text-white font-semibold items-center pr-10 text-3xl space-x-10">
            
            <a href="http://tp-quizz.test/quizz/quizz-start.php"><button id="btnQuizz" class=" hover:text-gray-400">Quizz</button></a>

            <a href="http://tp-quizz.test/authentification/log-in.php"> <button class=" hover:text-gray-400">Log out</button> </a>

        </div>

    </header>

    <div class="grow flex flex-col z-10 justify-center items-center space-y-10">

        <div class="h-1/2 w-10/12 bg-white rounded-2xl p-5 flex flex-col">

            <h1 class=" text-blue-800 text-4xl font-semibold place-self-center sticky">Leader board</h1>
            
            <div class="grow">            
                
                <canvas id="myChart"></canvas>

            </div>

        </div>

        <div class="bg-white w-10/12 h-1/3 space-y-5 rounded-2xl p-5">

            <h1 class=" text-blue-800 text-4xl font-semibold place-self-center sticky">Users list</h1>

            <div class="flex flex-row space-x-5">

                <?php foreach ($users as $value) { ?>

                            <p class ="text-2xl w-1/5"><?php echo $value["name"]; ?></p>

                <?php } ?>

            </div>

        </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($userNames); ?>,
      datasets: [{
        label: '# of users',
        data: <?php echo json_encode($maxScores); ?>,
        borderWidth: 1
      }]
    },
    options: {
        maintainAspectRatio: false,
      }
    }
  );
</script>
<script src="script.js"></script>
</html>

