<?php
session_start();

require_once('CRUD/DatabaseConnection.php');

// Create an instance of the DatabaseConnection class
$databaseInstance = new DatabaseConnection();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or perform other actions
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$createdById = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;

$companyName = '';
$contactPerson = '';
$phone = '';
$address = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ok = true;

    if (empty($_POST['company-name'])) {
        $ok = false;
        $_SESSION['error_message'] = "Company Name is required";
    } else {
        $companyName = $_POST['company-name'];
    }

    $contactPerson = isset($_POST['contact-person']) ? $_POST['contact-person'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // Validate phone number
    if (empty($phone)) {
        $ok = false;
        $_SESSION['error_message'] = "Phone number is required";
    } elseif (!ctype_digit($phone)) {
        $ok = false;
        $_SESSION['error_message'] = "Phone number should contain only digits";
    }

    if ($ok) {
        $result = $databaseInstance->insertClientData($companyName, $contactPerson, $phone, $address, $createdById);

        if ($result === 'Data Inserted') {
            // Redirect to the dashboard upon successful client creation
            $_SESSION['success_message'] = "Client created successfully";
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['error_message'] = $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Client</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <?php include 'toast.php';
    include 'header.php';
    ?>
    <form action="createClient.php" method="post">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-md mt-20" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="space-y-2 text-center p-4">
                <h1 class="text-3xl font-bold">Client Registration</h1>
                <p class="text-gray-500 dark:text-gray-400"></p>
            </div>
            <div class="space-y-4 p-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="company-name">Company Name</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="company-name" name="company-name" placeholder="Your Company Name" required="" value="<?= htmlspecialchars($companyName) ?>">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="contact-person">Contact Person</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="contact-person" name="contact-person" placeholder="John Doe" required="" value="<?= htmlspecialchars($contactPerson) ?>">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="phone">Phone</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="phone" name="phone" placeholder="(123) 456-7890" required="" value="<?= htmlspecialchars($phone) ?>">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="address">Address</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="address" name="address" placeholder="123 Main St, City, State, ZIP" required="" value="<?= htmlspecialchars($address) ?>">
                </div>
                <button class="text-white bg-[#1A202C] inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit">
                    Create Client
                </button>
            </div>
        </div>
    </form>
    <script src="dashboard.js"></script>
</body>

</html>