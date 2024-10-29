<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log in</title>
</head>
<body class=" flex justify-center items-center h-screen">

<img src="../images/paysage.jpg" class=" absolute h-full w-full z-0">

<div class=" flex flex-col p-5 space-y-5 z-10 bg-white pt-10 pb-10 rounded-2xl px-10">

    <h1 class=" place-self-center text-4xl font-semibold text-blue-800">Log in</h1>
        
    <form action="log-in-sql.php" method="post">
        <label for="userName" class=" text-2xl font-semibold">User name :</label>
        <div class=" text-red-600"><?php if (isset($_GET["user-name"])) {echo " ","The user does not exist";}?></div>
        <input type="text" name="userName" class=" border-4 border-gray-400 rounded-2xl px-2 text-2xl py-1 hover:bg-slate-50">
        <button type="submit" class="border-4 border-gray-400 p-1 px-4 rounded-2xl shadow-xl text-xl font-semibold hover:text-blue-800 hover:border-blue-800">Log in</button>
    </form>

    <label for="link" class=" text-3xl font-semibold text-blue-800 place-self-center">You are new ?</label>
    <a href="sign-in.php" class=" place-self-center border-4 border-gray-400 p-1 px-4 rounded-2xl shadow-xl text-xl font-semibold hover:text-blue-800 hover:border-blue-800">Sign up</a>

</div>

</body>
</html>