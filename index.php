<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <!-- For Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- For Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Swiper CSS -->
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>

     <!-- Boxicons CSS -->
     <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script>
        MathJax = {
            tex: {
                inlineMath: [
                    [
                        '$',
                        '$'
                    ],
                    [
                        '\\(',
                        '\\)'
                    ]
                ]
            }
        };
    </script>

    <title>Педагогика</title>
</head>

<body onload="initClock()">

    <section id="timeSection">
        <div class="timeMailInfo">
            <div class="time_side">
                <span id="dayname">Day</span>,
                <span id="month">Month</span>
                <span id="daynum">00</span>
                <span id="year">Year</span>,
                <span id="time"></span>
            </div>
            <div class="mail_side">
                <span class="mail"><i class="bi bi-envelope"></i>najibullahrht@mail.ru</span>
                <span class="phone"><i class="bi bi-telephone"></i>+7 (778) 892-17-90</span>
            </div>
        </div>
    </section>

    <section id="header">
        <div class="wrapper">
            <div class="navbar">
                <!----------------------- Start Logo -------------------------->
                <div class="logo_toggle">
                    <img src="./images/logo.svg" alt="" class="logo">
                    <div class="toggle">
                        <i class="bi bi-list"></i>
                        <!-- <i class="bi bi-x-lg"></i> -->
                    </div>
                </div>
                <!----------------------- End Logo ---------------------------->
                <!----------------------- Start Menu -------------------------->
                <div class="menu">
                    <ul class="list-items">
                        <?php if (isset($user)): ?>
                    <div class="logout">
                        <li class="list-links testBtn"><a href="#">Tест</a></li>
                        <li class="list-links booksBtn"><a href="#">Оқулықтар</a></li>
                        <div class="dropdown">
                            <img src="./images/logoutImage.jpg" alt="" class="logout_image">
                            <div class="dropdown-content">
                            <p class="hello">Сәлеметсіз бе,
                            <?= htmlspecialchars($user["name"]) ?>
                            <p class="account_logout"><a href="logout.php">Шығу</a></p>
                        </p>

                            </div>
                        </div>
                        
                    </div>
                        

                        <?php else: ?>

                        <li class="list-links testBtn"><a href="#">Tест</a></li>
                        <li class="list-links booksBtn"><a href="#">Оқулықтар</a></li>
                        <!-- <li class="list-links"><a href="#">Біз жайлы</a></li> -->
                        <li class="list-links login account"><a href="login.php">Кіру</a></li>
                        <li class="list-links signup account"><a href="signup.html">Тіркелу</a></li>

                        <?php endif; ?>
                        
                    </ul>
                </div>
                <!----------------------- End Menu ---------------------------->
            </div>

            <div class="content">
                <div class="content-box">
                    <h1 class="content-title">Педагогика</h1>
                    <div class="content-info">
                        <p class="content-text">Бұл сайт мұғалімдердің педагогикаға деген дайындығына көмек үшін
                            жасалынды</p>
                    </div>
                    <div class="btns">
                        <?php if (isset($user)): ?>
                        <div class="start_quiz"><button class="content-btn blue">Тест тапсыру</button></div>
                        <?php else: ?>
                            <div class="login_or_signup"><a href="login.php" class="content-btn blue">Тест тапсыру</a></div>
                        <?php endif; ?>
                        <div class="donateBtn"><button class="content-btn">Сайтты қолдау</button></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="quizSection">
        <div class="quiz-container">
            <header>
                <span class="question-total-number">1.</span>
                <p class="title">Педагогика тест тапсырмалары</p>
                <span class="time">11:00</span>
            </header>
            <div class="question-box">
                <span class="question-number">1.</span>
                <p id="question"></p>
            </div>
            <div class="answer-box">
                <p id="answer1" class="answers"></p>
                <p id="answer2" class="answers"></p>
                <p id="answer3" class="answers"></p>
                <p id="answer4" class="answers"></p>
                <p id="answer5" class="answers"></p>
                <p id="correct" class="answers"></p>
            </div>
            <footer>
                <div class="btn-exit-next">
                    <button class="next-btn">Келесі</button>
                    <button class="exit-btn">Тесттен шығу</button>     
                </div>
                <div class="btn">
                    <ul>
                        <li><span class="warning_test">* Ескерту: Бұл сайттың тест сұрақтары әліде толықтырылу үстінде!
                            </span></li>
                        <li><span class="warning_test">Тест тапсыру барысында қандай да бір қате байқасаңыз, скриншот
                                жасап админнің ватсабына жіберіңіз. Бұл бізге сайтты сіз үшін қатесіз етіп жасауға
                                көмектеседі!</span></li>
                    </ul>
                    
                </div>
                
            </footer>
        </div>
        <div class="result">
            <div class="result-header">
                <span class="result-title">Нәтижесі</span>
            </div>
            <div class="result-body">
                <span class="result-total-ques">Барлығы:</span>
                <!-- <span class="result-total-apply">Орындалғаны:</span> -->
                <span class="result-total-valid-ques">Дұрыс жауаптар:</span>
                <span class="result-total-invalid-ques">Қате жауаптар:</span>
                <span class="result-total-percentage">Пайызы:</span>
                <!-- <span class="result-total-percentage-apply">Жалпы тест бойынша пайызы:</span> -->
            </div>
            <div class="result-footer">
                <!-- <button class="replay">Қайталау</button> -->
                <button class="exit">Шығу</button>
            </div>
        </div>
        
    </section>

    <section id="donate">
        <div class="donate-container">
            <div class="header_donate">
                <h1 class="donate_title">Сайттың құрастырушысы</h1>
                <button class="btn_close">X</button>
            </div>
            <div class="author">
                <div class="about_author">
                    <img src="./images/author.jpeg" class="author_img" alt="author">
                    <span>Рахатұлы Мажидолда</span>
                </div>
                <div class="info_author">
                    <p><span class="titles">Мамандығы:</span> Математика пәнінің мұғалімі</p>
                    <p><span class="titles">Мақсаты:</span> Мұғалімдердің аттестацияға дайындығын жеңілдету</p>
                    <p><span class="titles">Жоспары:</span> Бұл сайтты, келешекте мұғалімдер аттестацияға және оқушылар
                        ҰБТ-ға дайындық ретінде тегін тест тапсыратын сайт етіп дамыту</p>
                </div>
            </div>
            <div class="donate_pay">
                <img class="kaspi_icon" src="./images/kaspi.png" alt="">
                <span class="about_kaspi_donate">* Қолдау көрсетіңіз. Сіздің жасаған қолдауыңыз базаға жаңа тест
                    сұрақтарын қосуға арналады. + 7 (778)-892-1790, Мажидолда Р. </span>
            </div>
        </div>
    </section>

    <section id="news">
        <h1 class="content-title">Жаңалықтар</h1>
        <div class="testimonial mySwiper">
        <div class="testi-content swiper-wrapper">
          <div class="slide swiper-slide">
            <img src="./images/newsImages/img4.jpeg" alt="" class="image" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam,
              saepe provident dolorem a quaerat quo error facere nihil deleniti
              eligendi ipsum adipisci, fugit, architecto amet asperiores
              doloremque deserunt eum nemo.
            </p>

            <i class="bx bxs-quote-alt-left quote-icon"></i>

            <div class="details">
              <span class="name">Рахатұлы Мажидолда</span>
              <span class="job">Математика пәнінің мұғалімі</span>
            </div>
          </div>
          <div class="slide swiper-slide">
            <img src="./images/newsImages/1.png" alt="" class="image" />
            <p>
              Бұл орынға өз жарнамаңызды орналастырыңыз. Ол үшін төмендегі байланыс нөміріне хабарласыңыз! 
            </p>

            <i class="bx bxs-quote-alt-left quote-icon"></i>

            <div class="details">
              <span class="name">Толық аты-жөні</span>
              <span class="job">Мамандығы</span>
            </div>
          </div>
          <div class="slide swiper-slide">
            <img src="./images/newsImages/1.png" alt="" class="image" />
            <p>
            Бұл орынға өз жарнамаңызды орналастырыңыз. Ол үшін төмендегі байланыс нөміріне хабарласыңыз! 
            </p>

            <i class="bx bxs-quote-alt-left quote-icon"></i>

            <div class="details">
              <span class="name">Толық аты-жөні</span>
              <span class="job">Мамандығы</span>
            </div>
          </div>
        </div>
        <div class="swiper-button-next nav-btn"></div>
        <div class="swiper-button-prev nav-btn"></div>
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section id="footerSite">
        <div class="aboutSite">
            <div class="pos">
                <p  class="aboutSite_title">Мекенжайы:</p>
                <p>Екібастұз қаласы, Солнечный кенті, <br> Бейбітшілік көшесі</p>
            </div>
            <div class="call">
                <p  class="aboutSite_title">Байланыс телефоны:</p>
                <p>+7 (778)-892-17-90</p>
            </div>
            <div class="indexPos">
                <p  class="aboutSite_title">Почта индексі:</p>
                <p>141216</p>
            </div>
        </div>
        <div class="copyrigth">
            &copy <span id="copyrigth_year"></span> Мажидолда Рахатұлы
        </div>
    </section>

    <!-- Inside this JavaScript file I've inserted Questions and Options only -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="./js/swiper.js"></script>
    <script type="text/javascript" src="./js/questions.js"></script>
    <!-- Inside this JavaScript file I've coded all Quiz Codes -->
    <script type="text/javascript" src="js/script.js"></script>

    <script type="text/javascript" src="./js/time.js"></script>
    <script type="text/javascript" src="https://spikmi.org/Widget?Id=15982"></script>
    <script type="text/javascript" src="./js/toggleMenu.js"></script>
    <script type="text/javascript" src="./js/btns.js"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</body>

</html>