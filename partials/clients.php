<?php
require_once 'CRUD/DatabaseConnection.php';

$databaseInstance = new DatabaseConnection();
$clients = $databaseInstance->selectData('clients', 'company_id');
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

<body>
    <div class="page-transition border text-card-foreground p-4 shadow-md rounded-md bg-white dark:bg-gray-800" id="clients-table-container">
        <h3 class="text-white tracking-tight text-lg font-semibold">
            Clients Info
        </h3>
        <div class="p-6">
            <form action="deleteClients.php" method="post">
                <div class="table-responsive">
                    <table class="min-w-full table-auto container mt-4 text-sm" id="clients-table">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: left;">ID</th>
                                <th scope="col" style="text-align: left;">Company Name</th>
                                <th scope="col" style="text-align: left;">Contact Person</th>
                                <th scope="col" style="text-align: left;">Phone</th>
                                <th scope="col" style="text-align: left;">Address</th>
                                <th scope="col" style="text-align: left;">Created By</th>
                                <th scope="col" style="text-align: left;">Created At</th>
                                <th scope="col" style="text-align: left;">Edited At</th>
                                <th scope="col" style="text-align: left;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($clients)) : ?>
                                <?php foreach ($clients as $client) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($client['company_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['company_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['contact_person'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['address'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['created_by'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?= htmlspecialchars($client['edited_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <a href="editClient.php?company_id=<?= $client['company_id']; ?>" class="text-blue-500 hover:underline text-sm">Edit</a> /
                                            <form action="deleteClients.php" method="post" style="display:inline;">
                                                <input type="hidden" name="delete-company-id" value="<?= $client['company_id']; ?>">
                                                <button type="submit" class="text-red-500 hover:underline text-sm" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9">No clients available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</body>

</html>