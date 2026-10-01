<?php
// loginForm.php
session_start();
include 'toast.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('login-validation.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="dashboard.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <?php
    include 'toast.php';
    include 'header.php';
    ?>
    <form action="login-validation.php" method="post">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-md mt-40" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="flex flex-col p-6 space-y-1">
                <h3 class="tracking-tight text-2xl font-bold">Login</h3>
                <p class="text-sm text-muted-foreground">
                    Enter your username and password to access your account
                </p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">Email</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium" id="email" name="email" placeholder="Enter email" required type="email">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">Password</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium" id="password" name="password" placeholder="Enter password" required type="password">
                    </div>
                    <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-[#1A202C] h-10 px-4 py-2 w-full text-white" type="submit" id="loginBtn">
                        Login
                    </button>
                    <p class="text-sm text-center text-gray-500 mt-2">
                        <a href="createUser.php" class="text-primary-foreground hover:underline">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </form>

</body>

</html>