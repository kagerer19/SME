<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="dashboard.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Login Form</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <?php include 'header.php'; ?>
    <main class="flex flex-col items-center justify-center text-white py-20">
        <h1 class="text-4xl font-bold mb-6 md:mb-10 lg:mb-12 xl:mb-16 text-center px-4 md:px-6 lg:px-8 xl:px-12">
            Welcome to ProConnect Inc.
        </h1>

        <div class="custom-container text-black rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-md p-6 md:w-1/2 lg:w-2/3 xl:w-3/4 lg:mx-auto xl:mx-0 xl:w-1/2 xl:my-10" style="background-color: rgba(255, 255, 255, 0.8);">
            <p class="text-sm text-muted-foreground text-center mb-4">
                Welcome to our Customer Management System – the essential tool for seamlessly managing your customer data. Tailored for Small and Medium-sized Enterprises (SMEs), our system empowers you to effortlessly store, edit, and view customer information with precision. Engineered for a secure and efficient database connection, our system provides robust functionality without compromise.
                While we don't use PDO, our system ensures reliability and ease of use, putting you in complete control of your customer data. Elevate your business operations with the simplicity and power of our intuitive Customer Management System.
            </p>
            <div class="text-center">
                <a href="login.php" class="inline-block bg-[#1A202C] text-white rounded-md text-sm font-medium py-2 px-4 md:px-7">Login</a>
                <p class="text-sm text-gray-500 mt-2">
                    <a href="createUser.php" class="text-primary-foreground hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </main>
</body>

</html>