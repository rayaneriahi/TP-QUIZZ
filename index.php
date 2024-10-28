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

if (empty($_SESSION["userName"])) {
    header("Location: http://tp-quizz.test/authentification/sign-in.php");
} else {
    header("Location: http://tp-quizz.test/quizz/quizz-start.php");
}

?>

</body>
</html>