<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quizz</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- 1 tableau des scores et 1 graphique en barre -->  
<div>
  <canvas id="myChart"></canvas>
</div>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Géographie', 'Histoire', 'Mathématiques', 'Culture','Résultat Total'],
      datasets: [{
        label: 'Score Quentin',
        data: [5, 10, 15, 20, 50],
        borderWidth: 5
      },
      {
        label: 'Score Nicolas',
        data: [45, 50, 55, 60, 210],
        borderWidth: 5
      },
      {
        label: 'Score Rayane',
        data: [25, 30, 35, 40, 130],    
        borderWidth: 5
      }]
    },
    options: {
        responsive: true,
        maintainAspectRatio	: true,
    }
  });
</script>


<!-- 1 podium des meilleurs scores -->  
<div>
  <canvas id="myPodium"></canvas>
</div>

<script>
  const ctx1 = document.getElementById('myPodium');

  new Chart(ctx1 ,{
    type: 'bar',
    data: {
      labels: ['Podium classement'],
      datasets: [{
        label: 'Médaille Bronze Quentin',
        data: [50],
        borderWidth: 10
      },
      {
        label: 'Médaille Or Nicolas',
        data: [210],
        borderWidth: 10
      },
      {
        label: 'Médaille Argent Rayane',
        data: [130],
        borderWidth: 10
      },]
    },
    options: {
        responsive: true,
        maintainAspectRatio	: true,
    }
  });
</script>

</body>
</html>