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
<body class="min-h-screen w-full flex flex-col bg-cover bg-center" style="background-image: url('../images/paysage.jpg');">

<header class="flex flex-col sm:flex-row justify-between py-3 z-10 pt-10">
    <div class="pl-5 sm:pl-10 text-xl sm:text-3xl font-semibold text-white sm:flex sm:items-center space-y-2 sm:space-y-0 sm:space-x-10">
        <span><?php echo $user["name"]; ?></span>
        <span>Best score (<?php echo $user["max_score"]; ?>)</span>
    </div>

    <div class="flex flex-row text-white font-semibold items-center pr-5 sm:pr-10 text-xl sm:text-3xl space-x-5">
        <a href="http://tp-quizz.test/quizz/quizz-start.php">
            <button id="btnQuizz" class="hover:text-gray-400">Quizz</button>
        </a>
        <a href="http://tp-quizz.test/authentification/log-in.php">
            <button class="hover:text-gray-400">Log out</button>
        </a>
    </div>
</header>

    <div class="grow flex flex-col z-10 justify-center items-center space-y-4 sm:space-y-8 md:space-y-10 p-3 sm:p-4 md:p-6">

    <div class="min-h-1/2 h-auto sm:h-1/2 md:h-2/3 w-full sm:w-10/12 md:w-8/12 bg-white rounded-2xl p-3 sm:p-4 md:p-6 flex flex-col">

        <h1 class="text-blue-800 text-xl sm:text-3xl md:text-4xl font-semibold text-center">Leader board</h1>

        <div class="grow overflow-y-auto">            
            <canvas id="myChart"></canvas>
        </div>

    </div>

    <div class="bg-white w-full sm:w-10/12 md:w-8/12 h-auto sm:h-1/3 md:h-1/3 space-y-3 sm:space-y-5 md:space-y-6 rounded-2xl p-3 sm:p-5 md:p-6">

        <h1 class="text-blue-800 text-xl sm:text-3xl md:text-4xl font-semibold text-center">Users list</h1>

        <div class="flex flex-col sm:flex-row md:grid md:grid-cols-2 gap-3 sm:gap-5 overflow-y-auto max-h-40">
            <?php foreach ($users as $value) { ?>
                <p class="text-base sm:text-xl md:text-2xl w-full md:w-auto text-center sm:text-left">
                    <?php echo $value["name"]; ?>
                </p>
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

