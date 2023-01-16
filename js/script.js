const container = document.querySelector(".quiz-container");
const answerBox = document.querySelector(".answer-box");

const question = document.getElementById('question');
const answer1 = document.getElementById('answer1');
const answer2 = document.getElementById('answer2');
const answer3 = document.getElementById('answer3');
const answer4 = document.getElementById('answer4');
const answer5 = document.getElementById('answer5');
const correct = document.getElementById('correct');

const answers = document.querySelectorAll('.answers');

const startBtn = document.querySelector(".start_quiz");
const exitBtn = document.querySelector(".exit-btn");
const nextBtn = document.querySelector(".next-btn");
const questionNumber = document.querySelector(".question-number");
const questionTotalNumber = document.querySelector(".question-total-number");
const times = document.querySelector(".time");

// For Result Box
const resultBox = document.querySelector(".result");
const resultTotalQues = document.querySelector(".result-total-ques");
const resultTotalApply = document.querySelector(".result-total-apply");
const resultTotalValidQues = document.querySelector(".result-total-valid-ques");
const resultTotalInvalidQues = document.querySelector(".result-total-invalid-ques");
const resultTotalPercentage = document.querySelector(".result-total-percentage");
const resultTotalPercentageApply = document.querySelector(".result-total-percentage-apply");

const news = document.getElementById('news');
const content = document.querySelector('.content');
const footerSite = document.querySelector('#footerSite');

const replay = document.querySelector(".replay"); 
const exit = document.querySelector(".exit");

const mark_wrong = '<i class="bi bi-file-excel"></i>';
const mark_check = '<i class="bi bi-check-circle"></i>';

let num = 0;
let totalQuiz = 30;
let totalRandNum = 80;
let isNextBtnClicked = false;
let isStartBtnClicked = false;
let startimgMinutes = 30;
let timeCount = startimgMinutes * 60;

let score = 0;
// let clicked = 0;

let indexQuiz = [];
let indexs;

let newArr = {}

// window.onload = function () {
    // for (let i = 0; i < totalRandNum; i++) {
    //     rand = Math.floor(Math.random() * totalRandNum);
    //     indexQuiz.push(rand);
    //     indexs = [...new Set(indexQuiz)]
    // }
    // console.log("IndexQuiz " + indexQuiz)

    // console.log("Indexs " + indexs)





    // for (let i = 0; i < questions.length; i++) {
    //     for (let j = 0; j < questions.length; j++) {
    //         if (questions[i].answer == questions[j].answer)
    //             console.log(questions[i].answer)
    //     }
    // }
    // console.log(questions.length)

    // for (let i = 0; i < questions.length; i++) {
    //     if(questions[i].answer == "") {
    //         console.log(questions[i].numb);
    //     } else {
    //         console.log("All right!");
    //     }
    // }
// }

startBtn.addEventListener('click', function () {
    for (let i = 0; i < totalRandNum; i++) {
        rand = Math.floor(Math.random() * questions.length);
        indexQuiz.push(rand);
        indexs = [...new Set(indexQuiz)]
    }
    console.log("IndexQuiz " + indexQuiz)
    console.log("Indexs " + indexs)
    console.log(questions.length)



    container.classList.add("active");
    startGame(indexs.shift());
    // console.log(randomIndex());
    startBtn.classList.add("disable");

    isStartBtnClicked = true;

    nextBtn.classList.add("pointersEventBtn");

    setInterval(updateCountDown, 1000);

    news.classList.add("disable")
    content.classList.add("disable")
    footerSite.classList.add("disable")
})

nextBtn.addEventListener('click', function () {

    if (totalQuiz > num) {
        container.classList.add("active");
        startGame(indexs.shift());
        // console.log(randomIndex());

        isNextBtnClicked = true;

        if (isNextBtnClicked || isStartBtnClicked) {
            for (let i = 0; i < answers.length; i++) {
                // console.log("deactive removed!");
                answers[i].classList.remove("deactive");

                answers[i].style.backgroundColor = ""
                answers[i].style.color = ""
            }
        }

        nextBtn.classList.add("pointersEventBtn");
    } else {
        console.log("Quiz complete!")
        container.classList.remove("active");
        resultBox.classList.add("active");
        result();
    }
})

exitBtn.addEventListener('click', function () {
    let isExit = confirm("Сіз шынымен тест тапсырмаларын тоқтатқыңыз келе ме?");
    if (isExit) {
        container.classList.remove("active");
        startBtn.classList.remove("disable")
        num = 0;
        window.location.reload();
    } else {
        return false;
    }
})

function startGame(rand) {

    num++;

    questionNumber.textContent = num + ".";

    let totalNumber = num + "/" + totalQuiz;
    questionTotalNumber.textContent = totalNumber;

    if (num == totalQuiz) {
        nextBtn.textContent = "Аяқтау";
    }

    container.classList.add("active");
    question.innerHTML = questions[rand].question;
    answer1.innerHTML = questions[rand].options[0]
    answer2.innerHTML = questions[rand].options[1]
    answer3.innerHTML = questions[rand].options[2]
    answer4.innerHTML = questions[rand].options[3]
    answer5.innerHTML = questions[rand].options[4]


    // answer1.innerHTML = questions[rand].options[0].charAt(0).toUpperCase() + questions[rand].options[0].slice(1);
    // answer2.innerHTML = questions[rand].options[1].charAt(0).toUpperCase() + questions[rand].options[1].slice(1);
    // answer3.innerHTML = questions[rand].options[2].charAt(0).toUpperCase() + questions[rand].options[2].slice(1);
    // answer4.innerHTML = questions[rand].options[3].charAt(0).toUpperCase() + questions[rand].options[3].slice(1);
    // answer5.innerHTML = questions[rand].options[4].charAt(0).toUpperCase() + questions[rand].options[4].slice(1);
    // correct.innerHTML = questions[rand].answer;

    checkAnswers(rand);
}

const randomIndex = () => {
    return Math.floor(Math.random() * questions.length)
}

const checkAnswers = (ans) => {
    answers.forEach(btn => {
        btn.addEventListener('click', function (e) {
            // preventDefault(e);
            if (e.target.textContent == questions[ans].answer) {
                e.target.style.backgroundColor = "#00bb3e"
                e.target.style.color = "white"

                // e.target.insertAdjacentHTML("beforeend", mark_check);

                score++;
                console.log("Score: " + score);

            } else if (e.target.textContent != questions[ans].answer) {
                e.target.style.backgroundColor = "red"
                e.target.style.color = "white"

                switch (questions[ans].answer) {
                    case answer1.textContent:
                        answer1.style.backgroundColor = "#00bb3e";
                        answer1.style.color = "white";
                        break;
                    case answer2.textContent:
                        answer2.style.backgroundColor = "#00bb3e";
                        answer2.style.color = "white";
                        break;
                    case answer3.textContent:
                        answer3.style.backgroundColor = "#00bb3e";
                        answer3.style.color = "white";
                        break;
                    case answer4.textContent:
                        answer4.style.backgroundColor = "#00bb3e";
                        answer4.style.color = "white";
                        break;
                    case answer5.textContent:
                        answer5.style.backgroundColor = "#00bb3e";
                        answer5.style.color = "white";
                        break;
                    default:
                        // console.log("Answer found!");
                        break;
                }

                // e.target.insertAdjacentHTML("beforeend", mark_check);
            }

            for (let i = 0; i < answers.length; i++) {
                // console.log("deactive added!");
                answers[i].classList.add("deactive");
            }

            nextBtn.classList.remove("pointersEventBtn");
            // clicked++;
            // console.log("Clicked "+clicked)
        })
    })
}

function updateCountDown() {
    const minutes = Math.floor(timeCount / 60);
    let seconds = timeCount % 60;
    timeCount--;

    seconds = seconds < 10 ? '0' + seconds : seconds;

    times.innerHTML = minutes + ":" + seconds;

    if (minutes == 0 && seconds == 0) {
        container.classList.remove("active");
        resultBox.classList.add("active");
        result();
    }
}

function result() {
    resultTotalQues.textContent = "Барлығы: " + totalQuiz;
    // resultTotalApply.textContent = "Орындалғаны: " + clicked;
    resultTotalValidQues.textContent = "Дұрыс жауаптар: " + score;
    resultTotalInvalidQues.textContent = "Қате жауаптар: " + (totalQuiz - score);
    resultTotalPercentage.textContent = "Пайызы: " + ((score * 100) / totalQuiz).toFixed(1) + "%";
    // resultTotalPercentageApply.textContent = "Жалпы тест бойынша пайызы: " + ((score * 100) / clicked).toFixed(1) + "%";
}

exit.addEventListener('click', function () {
    window.location.reload();
})

// replay.addEventListener('click', function() {

//     container.classList.add("active");
//     resultBox.classList.remove("active");
//     startGame(randomIndex());
//     // console.log(randomIndex());
//     startBtn.classList.add("disable");

//     isStartBtnClicked = true;

//     nextBtn.classList.add("pointersEventBtn");

//     setInterval(updateCountDown, 1000)
// })


