<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Quizz</title>
</head>
<body class=" bg-orange-200 h-screen flex flex-col">

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

    <div class=" flex flex-col pl-10 text-2xl space-y-2">
<?php

    echo "<span>".$user["name"]."</span>";

    echo "<span>Best score (".$user["max_score"].")</span>";

?>
    </div>

    <div class=" flex flex-row items-center pr-10 text-2xl space-x-10">

        <a href="http://tp-quizz.test/quizz/quizz-start.php"> <button>Quizz</button> </a>

        <a href="http://tp-quizz.test/authentification/log-in.php"> <button>Log out</button> </a>

    </div>

</header>

<div>
  <canvas id="myChart"></canvas>
</div>

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
      responsive: true,
      maintainAspectRatio: false,
      },
  })
</script>

</body>
<script src="quizz.js"></script>
</html>

