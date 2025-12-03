<?php
// Assuming you have a DatabaseConnection class with a method selectData
require_once 'CRUD/DatabaseConnection.php';

// Create an instance of the DatabaseConnection class
$databaseInstance = new DatabaseConnection();

// Fetch users from the 'users' table
$users = $databaseInstance->selectData('users', 'name');

// Check for errors
if (is_string($users)) {
    // Log the error and show a generic message
    error_log($users);
    $errorMessage = 'An error occurred while fetching user data.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="dashboard.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>

<body>
    <div class="page-transition border text-card-foreground p-4 shadow-md rounded-md bg-white dark:bg-gray-800" id="users-table-container">
        <h3 class="text-white tracking-tight text-lg font-semibold">
            Users Info
        </h3>
        <div class="p-6">
            <?php if (isset($errorMessage)) : ?>
                <div class="text-red-500"><?= $errorMessage; ?></div>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table-auto container mt-4" id="users-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 30px; text-align: left; vertical-align: top;">ID</th>
                                <th scope="col" style="width: 150px; text-align: left; vertical-align: top;">Name</th>
                                <th scope="col" style="width: 200px; text-align: left; vertical-align: top;">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['user_id'], ENT_QUOTES); ?></td>
                                        <td><?= htmlspecialchars($user['name'], ENT_QUOTES); ?></td>
                                        <td><?= htmlspecialchars($user['email'], ENT_QUOTES); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4">No users available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>