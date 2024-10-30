const btnStart = document.querySelector("#btnStart");
const realBody = document.querySelector("body")
const body = document.querySelector("#body")
const btnUsers = document.querySelector("#btnUsers")
let intervalId

btnStart.addEventListener("click", () => {
    let questionNumber = 0
    fetch("http://tp-quizz.test/quizz/quizz-number.php")
    bodyQuizz(questionNumber)
})

// btnUsers.addEventListener("click", () => {
//     fetchUsers()
// })

//démarrer le timer
function startInterval(timer, data, questionNumber) {
    let i = 0;
    let number = 14;
    intervalId = setInterval(() => {
        if (number - i === 110) {
            clearInterval(intervalId);

            fetch(`http://tp-quizz.test/quizz/answer.php?answer=false&question-id=${data}`)

            questionNumber = questionNumber + 1

            bodyQuizz(questionNumber)
        } else {
            let numberTimer = number - i;
            timer.innerHTML = numberTimer + " sec";
        }
        i++;
    }, 1000);
}

function showScoreChart(answers) {
const ctx = document.getElementById('myChart');

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
    return stat.correct == 0 ? 0 : 100 / stat.total * stat.correct;
  })

console.log(results)


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
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return value + '%';
            },
            format: {
                style: 'percent'
            }
          }
        }
      }
    }
  });
}

//Afficher la page Lost
async function bodyLost(body) {
    const response = await fetch("http://tp-quizz.test/quizz/quizz-lost.php")
    const data = await response.json()
    body.innerHTML = `<div class=" flex flex-col bg-white p-16 rounded-2xl place-items-center w-max">

    <div class="flex flex-col items-center justify-center space-y-10">

        <h1 class="text-5xl font-semibold text-blue-800">You lost ...</h1>

        <canvas id="myChart"></canvas>

        <button class=" text-3xl border-spacing-12 border-4 border-gray-400 rounded-2xl font-semibold shadow-xl py-1 h-16 w-60 hover:text-blue-800 hover:border-blue-800" id="btnRestart">Restart</button>

    </div>

</div>`

    const header = document.querySelector("header")
    fetchHeader(header)

    const btnRestart = document.querySelector("#btnRestart")
    btnRestart.addEventListener("click", () => {
        fetch("http://tp-quizz.test/quizz/quizz-number.php")
        let questionNumber = 0
        bodyQuizz(questionNumber)
    })

    fetch("http://tp-quizz.test/quizz/score-reset.php")

    showScoreChart(data.answers);

}

//Afficher la page Quizz
async function bodyQuizz(questionNumber) {
    const response = await fetch("http://tp-quizz.test/quizz/quizz.php")
    const data = await response.json()
    console.log(data.questionsCount, questionNumber)
    if (questionNumber !== data.questionsCount) {
        const body = document.querySelector("#body")
        body.innerHTML = `<div class="space-y-10 pt-10 bg-white w-10/12 rounded-2xl">

        <div class="flex flex-row w-full">

            <p class="text-3xl font-semibold w-1/3 pl-10">Theme : ${data.questionTheme}</p>
            
            <p id="timer" class="text-3xl font-semibold w-1/3 text-center">15 sec</p>


        </div>

        <div class="place-self-center">

                <h1 class="text-4xl font-semibold text-blue-800">${data.question}</h1>
                
        </div>

        <div class="place-self-center flex flex-col w-full space-y-6">

            <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="${data.question1IsCorrect}"> <p class="text-2xl">${data.question1}</p></button>

            <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="${data.question2IsCorrect}"> <p class="text-2xl">${data.question2}</button>

            <button class="btnsAnswer font-semibold text-3xl border-4 border-slate-400 px-2 mx-20 rounded-2xl py-1 place-items-start pl-5 hover:border-blue-800 hover:text-blue-800" id="${data.question3IsCorrect}"> <p class="text-2xl">${data.question3}</button>

        </div>

        <p id="score" class="place-self-center pb-10 text-3xl font-semibold">Score : ${data.currentScore}</p>

    </div>`

        const timer = document.querySelector("#timer");
        startInterval(timer, data.questionId, questionNumber)

        const btnsAnswer = document.querySelectorAll(".btnsAnswer")
        btnsAnswer.forEach((btn) => {
            btn.addEventListener("click", () => {
                answer(btn, data, questionNumber)
            })
        })
    } else {
        const body = document.querySelector("#body")
        bodyLost(body)
    }
}

//Vérifier les réponse
function answer(btn, data, questionNumber) {
    if (btn.id == 1) {
        answerTrue(data, questionNumber)
    } else {
        answerFalse(data, questionNumber)
    }
}

function answerFalse(data, questionNumber) {
    clearInterval(intervalId);
    fetch(`http://tp-quizz.test/quizz/answer.php?answer=false&question-id=${data.questionId}`)
    
    questionNumber = questionNumber + 1

    bodyQuizz(questionNumber)
}

async function answerTrue(data, questionNumber) {
    fetch("http://tp-quizz.test/quizz/score-plus.php")

    clearInterval(intervalId);
    fetch(`http://tp-quizz.test/quizz/answer.php?answer=true&question-id=${data.questionId}`)

    questionNumber = questionNumber + 1

    bodyQuizz(questionNumber)
}

//Afficher le header
async function fetchHeader(header) {
    const response = await fetch("http://tp-quizz.test/quizz/score-max.php")
    const data = await response.json()
    header.innerHTML =    `<div class=" pl-10 text-3xl font-semibold text-white space-x-10">

    <span>${data.userName}</span>

    <span>Best score : ${data.bestScore}</span>

</div>

<div class=" flex flex-row text-white font-semibold items-center pr-10 text-3xl space-x-10">
    
    <a href="http://tp-quizz.test/quizz/user-list.php"><button class=" hover:text-gray-400">Users</button></a>

    <a href="http://tp-quizz.test/authentification/log-in.php"> <button class="hover:text-gray-400">Log out</button> </a>

</div>`

    // const btnUsers = document.querySelector("#btnUsers")
    // btnUsers.addEventListener("click", () => {
    //     fetchUsers()
    //     console.log("click")
    // })
}

//Afficher users
// async function fetchUsers() {
//     const response = await fetch("http://tp-quizz.test/quizz/user-list.php")
//     const text = await response.text()
//     realBody.innerHTML = text
//     console.log("body")

//     const btnQuizz = document.querySelector("#btnQuizz")
//     btnQuizz.addEventListener("click", () => {
//         fetchQuizz()
//     })
// }

//Afficher le quizz start
// async function fetchQuizz() {
//     const response = await fetch("http://tp-quizz.test/quizz/fetch-quizz-start.php")
//     const text = await response.text()
//     realBody.innerHTML = text

//     const btnUsers = document.querySelector("#btnUsers")
//     btnUsers.addEventListener("click", () => {
//         const body = document.querySelector("#body")
//         fetchUsers(body)
//     })

//     const btnStart = document.querySelector("#btnStart")
//     btnStart.addEventListener("click", () => {
//         bodyQuizz()
//     })
// }
