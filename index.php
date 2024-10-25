<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>

<?php

if (!empty($_SESSION) && $_SESSION["connect"] == true) {
        if (isset($_GET["sign-in"])) {
            echo "<p>The user was created</p>";
        }
        if (isset($_GET["log-in"])) {
            echo "<p>The user exist</p>";
        }
}

?>
    
<a href="http://tp-quizz.test/authentification/sign-in.php">Sign-in</a>

</body>
</html>