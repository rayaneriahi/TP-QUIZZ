const btnStart = document.querySelector("#btnStart");
const realBody = document.querySelector("body")
const body = document.querySelector("#body")
const btnUsers = document.querySelector("#btnUsers")
let intervalId

btnStart.addEventListener("click", () => {
    bodyQuizz(body)
})

// btnUsers.addEventListener("click", () => {
//     fetchUsers()
// })

//démarrer le timer
function startInterval(timer) {
    let i = 0;
    let number = 29;
    intervalId = setInterval(() => {
        if (number - i === 0) {
            clearInterval(intervalId);
            const body = document.querySelector("#body")
            bodyLost(body)
        } else {
            let numberTimer = number - i;
            const timer = document.querySelector("#timer")
            timer.innerHTML = "(" + numberTimer + ") s";
        }
        i++;
    }, 1000);
}

function showScoreChart(answers) {
const ctx = document.getElementById('myChart');

/*
    ANSWERS EXAMPLE
    [
        {
            "is_correct": "0",
            "theme": "Géographie",
        },
        {
            "is_correct": "1",
            "theme": "Histoire",
        },
        {
            "is_correct": "0",
            "theme": "Géographie",
        },
        {
            "is_correct": "1",
            "theme": "Histoire",
        },
        {
            "is_correct": "0",
            "theme": "Géographie",
        },
    ]
*/

/*
    STATS EXAMPLE
    {
        "Histoire": {
            "total": 5,
            "correct": 3,
        },
        "Géographie": {
            "total": 5,
            "correct": 2,
        }
*/

  let stats = {};

  // Pour chaque answer
  for (const answer of answers) {
    // Si le thème n'existe pas dans stats, on le crée
    if (stats[answer.theme] === undefined) {
        stats[answer.theme] = {
            total: 0,
            correct: 0,
        };
    }

    // On incrémente le "total" du thème dans stats
    stats[answer.theme].total++;

    // SI la réponse est correcte, on incrémente le "correct" du thème dans stats
    if (answer.is_correct == 1) {
        stats[answer.theme].correct++;
    }
  }

  let themes = Object.keys(stats);
  let results = Object.values(stats).map((stat) => {
    return stat.correct == 0 ? 0 : stat.total / stat.correct * 100;
  })

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: themes,
      datasets: [{
        label: '# of users',
        data: results,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

//Afficher la page Lost
async function bodyLost(body) {
    const response = await fetch("http://tp-quizz.test/quizz/quizz-lost.php")
    const data = await response.json()
    console.log(data);
    body.innerHTML = `<div class=" flex flex-col space-y-28">

    <p class="text-xl flex flex-row-reverse pr-10 pt-5"><?php echo "Score (${data.currenst_score})" ?></p>


    <div class="flex flex-col items-center justify-center space-y-20">

        <h1 class="text-5xl">You lost ...</h1>

        <button class=" text-2xl px-10 border border-black rounded-xl shadow-xl py-1" id="btnRestart">Restart</button>

    </div>

</div>

<div>
  <canvas id="myChart"></canvas>
</div>`;

    const header = document.querySelector("header")
    fetchHeader(header)

    const btnRestart = document.querySelector("#btnRestart")
    btnRestart.addEventListener("click", () => {
        const body = document.querySelector("#body")
        bodyQuizz(body)
    })
    fetch("http://tp-quizz.test/quizz/score-reset.php")
    showScoreChart(data.answers);

}

//Afficher la page Quizz
async function bodyQuizz() {
    const response = await fetch("http://tp-quizz.test/quizz/quizz.php")
    const text = await response.text()
    const body = document.querySelector("#body")
    body.innerHTML = text

    const timer = document.querySelector("#timer");
    startInterval(timer)

    const btnsAnswer = document.querySelectorAll(".btnsAnswer")
    btnsAnswer.forEach((btn) => {
        btn.addEventListener("click", () => {
            answer(btn)
        })
    })
}

//Vérifier les réponse
function answer(btn) {
    if (btn.id == 1) {
        answerTrue()
    } else {
        answerFalse()
    }
}

function answerFalse() {
        clearInterval(intervalId);
        const body = document.querySelector("#body")
        bodyLost(body)
        console.log("no")
}

async function answerTrue() {
    clearInterval(intervalId);
    await fetch("http://tp-quizz.test/quizz/score-plus.php")
    const body = document.querySelector("#body")
    bodyQuizz(body)
}

//Afficher le header
async function fetchHeader(header) {
    const response = await fetch("http://tp-quizz.test/quizz/score-max.php")
    const text = await response.text()
    header.innerHTML = text

    const btnUsers = document.querySelector("#btnUsers")
    btnUsers.addEventListener("click", () => {
        fetchUsers()
        console.log("click")
    })
}

//Afficher users
async function fetchUsers() {
    const response = await fetch("http://tp-quizz.test/quizz/user-list.php")
    const text = await response.text()
    realBody.innerHTML = text
    console.log("body")

    const btnQuizz = document.querySelector("#btnQuizz")
    btnQuizz.addEventListener("click", () => {
        fetchQuizz()
    })
}

//Afficher le quizz start
async function fetchQuizz() {
    const response = await fetch("http://tp-quizz.test/quizz/fetch-quizz-start.php")
    const text = await response.text()
    realBody.innerHTML = text

    const btnUsers = document.querySelector("#btnUsers")
    btnUsers.addEventListener("click", () => {
        const body = document.querySelector("#body")
        fetchUsers(body)
    })

    const btnStart = document.querySelector("#btnStart")
    btnStart.addEventListener("click", () => {
        bodyQuizz()
    })
}
