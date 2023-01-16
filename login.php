<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Сайтқа кіру</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body class="signupForm">
        <?php if ($is_invalid): ?>
            <em>Жарамсыз логин</em>
        <?php endif; ?>
    
        <form method="post" class="forms">
            <h1>Сайтқа кіру</h1>

            <label for="email" class="nameLabel">Электронды почта</label>
            <input type="email" name="email" id="email" class="nameInput"
                   value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

            <label for="password" class="nameLabel">Құпия сөз</label>
            <input type="password" name="password" id="password" class="nameInput">

            <button class="enter">Кіру</button>
            <a href="signup.html" class="signup_btn">Тіркелу</a>

        </form>
</body>
</html>








