<?php 
session_start();

if(isset($_SESSION["username"]) && $_SESSION['role'] == 'user'){
    header("Location: user_page.php");
}

if(isset($_SESSION["username"]) && $_SESSION['role'] == 'admin'){
    header("Location: dashboard.php");
}

if(isset($_SESSION["username"]) && $_SESSION['role'] == 'manager'){
    header("Location: manager_page.php");
}
?>
<!DOCTYPE html>
<html class="h-full bg-slate-100" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
            'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
            'Helvetica Neue', sans-serif;
        }
    </style>
    <title>Crew Project</title>
</head>

<body class="flex flex-col items-baseline justify-center min-h-screen">
    <section class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl"> CREW Project </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48">
        Crew Project is a simple role management application with features for users, managers and admins. It's a HTML template starter pack.
        </p>
        <div class="flex flex-col gap-2 mb-8 lg:mb-16 md:flex-row md:justify-center">
            <a href="login.php" type="button" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Login as User
            </a>
            <a href="register.php" type="button" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Register as User
            </a>
            <a href="login.php" type="button" class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Login as Admin
            </a>
    </section>
</body>

</html>