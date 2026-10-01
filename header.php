<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="dashboard.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>ProConnect Inc.</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <header class="px-4 md:px-6 h-16 md:h-20 flex flex-col md:flex-row items-center bg-[#1A202C] text-white">
        <div class="flex items-center mb-2 md:mb-0">
            <a class="hidden md:flex items-center gap-3 text-lg font-semibold sm:text-base mr-4 hover:text-gray-300" href="index.php">
                <span class="w-6 h-6 mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"></path>
                        <path d="M9 18h6"></path>
                        <path d="M10 22h4"></path>
                    </svg>
                </span>
                <span class="hidden md:inline">ProConnect Inc.</span>
            </a>
        </div>
        <nav class="font-medium text-center sm:flex flex-row items-center space-x-5 md:space-x-10 text-sm lg:space-x-6">
            <a class="text-gray-500 dark:text-gray-400 hover:text-white" href="createUser.php">
                Register
            </a>
            <a class="text-gray-500 dark:text-gray-400 hover:text-white" href="login.php">
                Login
            </a>
        </nav>
    </header>
</body>

</html>