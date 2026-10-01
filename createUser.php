<?php
session_start();
require_once 'CRUD/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['company-name']);
    $email = trim($_POST['contact-person']);
    $password = trim($_POST['password']);

    // Basic validation
    $errors = [];

    if (empty($name)) {
        $_SESSION['error_message'] = "Name is required";
        header("Location: createUser.php");  // Redirect to login.php or any other appropriate page
        exit;
    }

    if (empty($email)) {
        $_SESSION['error_message'] = "Email is required";
        header("Location: createUser.php");  // Redirect to login.php or any other appropriate page
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format";
        header("Location: createUser.php");  // Redirect to login.php or any other appropriate page
        exit;
    }

    if (empty($password)) {
        $_SESSION['error_message'] = "Password is required";
        header("Location: createUser.php");  // Redirect to login.php or any other appropriate page
        exit;
    }

    $databaseInstance = new DatabaseConnection();
    $result = $databaseInstance->insertUserData($name, $email, $password);

    if ($result === 'Data Inserted') {
        // Set success message for the dashboard
        $_SESSION['success_message'] = "User registered successfully";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Failed to register user. Please try again later.";
        header("Location: createUser.php");  // Redirect to login.php or any other appropriate page
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="dashboard.js"></script>
    <title>Create User</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <?php
    include 'toast.php';
    include 'header.php';
    ?>
    <form action="createUser.php" method="post">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-md mt-20" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="space-y-2 text-center p-4">
                <h1 class="text-3xl font-bold">User Registration</h1>
                <p class="text-gray-500 dark:text-gray-400"></p>
            </div>
            <div class="space-y-4 p-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="company-name">Name</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="company-name" name="company-name" placeholder="Your Name" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="contact-person">Email</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="contact-person" name="contact-person" placeholder="JohnDoe@ex.com" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">Password</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm" id="password" name="password" placeholder="Enter password" required type="password">
                </div>
                <button class="text-white bg-[#1A202C] inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit">
                    Create User
                </button>
                <p class="text-sm text-center text-gray-500 mt-2">
                    <a href="login.php" class="text-primary-foreground hover:underline">Login here</a>
                </p>
            </div>
        </div>
    </form>


</body>

</html>