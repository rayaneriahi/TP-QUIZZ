<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quizz</title>
</head>
<body>
<div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Géographie', 'Histoire', 'Mathématiques', 'Culture', 'Santé'],
      datasets: [{
        label: 'Score Quentin',
        data: [5, 10, 15, 20, 25],
        borderWidth: 5
      },
      {
        label: 'Score Rayane',
        data: [30, 35, 40, 45, 50],
        borderWidth: 5
      },
      {
        label: 'Score Nicolas',
        data: [55, 60, 65, 70, 75],
        borderWidth: 5
      },]
    },
    options: {
        responsive: true,
        maintainAspectRatio	: true,
    }
  });

</script>

</div>
</body>
</html>