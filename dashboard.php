<?php
// Include the DatabaseConnection class
require_once 'CRUD/DatabaseConnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="dashboard.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Dashboard</title>
</head>

<body class="">
    <?php
    include 'toast.php';
    ?>
    <div class="flex h-screen bg-[#1A202C] dark:bg-gray-900">
        <!-- Navigation column (hidden on small screens) -->
        <div class="hidden md:flex flex-col w-64 bg-[#1A202C] p-4">
            <div class="flex items-center justify-start mb-4">
                <span class="ml-2 text-xl font-semibold dark:text-gray-100">
                    <a class="flex items-center gap-1 text-lg font-semibold sm:text-base mr-4" href="#">
                        ProConnect Inc
                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mb-1">
                            <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"></path>
                            <path d="M9 18h6"></path>
                            <path d="M10 22h4"></path>
                        </svg>
                    </a>
                    <p class="text-xs font-semibold dark:text-gray-300">
                        Logged in as: ( <?php echo isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Guest'; ?> )
                    </p>
                </span>
            </div>

            <nav class="flex-1 mt-4 text-white">
                <a href="?view=clients" class="group flex items-center px-2 py-2 mt-1 text-sm font-medium rounded-md <?= (!isset($_GET['view']) || $_GET['view'] === 'clients') ? 'text-gray-900 bg-gray-200' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:hover:text-white dark:hover:bg-gray-700 dark:text-gray-400' ?>" onclick="showLoading()">
                    <span id="loading" class="hidden loading"></span>Clients
                </a>
                <a href="?view=users" class="group flex items-center px-2 py-2 mt-1 text-sm font-medium rounded-md <?= (isset($_GET['view']) && $_GET['view'] === 'users') ? 'text-gray-900 bg-gray-200' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:hover:text-white dark:hover:bg-gray-700 dark:text-gray-400' ?>" onclick="showLoading()">
                    <span id="loading" class="hidden loading"></span>Users
                </a>
            </nav>
        </div>
        <div class="flex flex-col w-full">
            <!-- Header section (visible on small screens) -->
            <header class="flex justify-between items-center p-4 dark:bg-gray-800 dark:text-white">
                <h1 class="text-lg font-semibold">Dashboard</h1>
                <div class="flex space-x-4">
                    <a href="?view=clients" class="group flex items-center px-2 py-2 mt-1 text-sm font-medium rounded-md <?= (!isset($_GET['view']) || $_GET['view'] === 'clients') ? 'text-gray-900 bg-gray-200' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:hover:text-white dark:hover:bg-gray-700 dark:text-gray-400' ?> hidden-lg" onclick="showLoading()">
                        <span id="loading" class="loading"></span>Clients
                    </a>
                    <a href="?view=users" class="group flex items-center px-2 py-2 mt-1 text-sm font-medium rounded-md <?= (isset($_GET['view']) && $_GET['view'] === 'users') ? 'text-gray-900 bg-gray-200' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-900 dark:hover:text-white dark:hover:bg-gray-700 dark:text-gray-400' ?> hidden-lg" onclick="showLoading()">
                        <span id="loading" class="loading"></span>Users
                    </a>
                    <a class="bg-black hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded" href="createClient.php">Create Client</a>
                    <a class="hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded" href="logout.php">Logout</a>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-4 dash-bg text-white">
                <?php
                $view = isset($_GET['view']) ? $_GET['view'] : 'clients'; // Set a default value, e.g., 'default'
                $viewPath = 'partials/' . $view . '.php';

                if (file_exists($viewPath)) {
                    include($viewPath);
                } else {
                    echo "View not found";
                }
                ?>
            </main>
        </div>
    </div>
</body>

</html>