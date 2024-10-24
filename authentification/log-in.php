<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log in</title>
</head>
<body class=" bg-orange-200 flex justify-center items-center h-screen">

<div class=" border-orange-300 border-4 flex flex-col p-5 space-y-5">

    <h1 class=" place-self-center text-2xl">Log in</h1>
        
    <form action="log-in-sql.php" method="post" class=" space-y-5">
        <label for="userName" class=" text-lg">User name :</label>
        <div class=" text-red-600"><?php if (isset($_GET["user-name"])) {echo " ","The user does not exist";}?></div>
        <input type="text" name="userName" class=" border border-black rounded-lg px-2">
        <button type="submit" class="border border-black px-2 rounded-lg shadow-xl">Submit</button>
    </form>

    <label for="link" class=" text-lg">You are new ?</label>
    <a href="sign-in.php" class=" place-self-center border border-black px-2 rounded-lg shadow-xl">Sign in</a>

</div>

</body>
</html>