const btnStart = document.querySelector("#btnStart");
const realBody = document.querySelector("body")
const body = document.querySelector("#body")
const btnUsers = document.querySelector("#btnUsers")
let intervalId

btnStart.addEventListener("click", () => {
    bodyQuizz(body)
})

btnUsers.addEventListener("click", () => {
    fetchUsers()
})

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

//Afficher la page Lost
async function bodyLost(body) {
    const response = await fetch("http://tp-quizz.test/quizz/quizz-lost.php")
    const text = await response.text()
    body.innerHTML = text

    const header = document.querySelector("header")
    fetchHeader(header)

    const btnRestart = document.querySelector("#btnRestart")
    btnRestart.addEventListener("click", () => {
        const body = document.querySelector("#body")
        bodyQuizz(body)
    })
    fetch("http://tp-quizz.test/quizz/score-reset.php")

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
