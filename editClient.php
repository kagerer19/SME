<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'CRUD/DatabaseConnection.php';
$db = new DatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $companyID = $_POST['edit-company-id'];

    // Fetch client data based on the client ID
    $clientData = $db->getClientData($companyID);

    // Check if the user attempting to edit is the one who created the entry
    if ($_SESSION['user']['user_id'] == $clientData['created_by']) {
        // Retrieve other form data
        $companyName = $_POST['edit-company-name'];
        $contactPerson = $_POST['edit-contact-person'];
        $phone = $_POST['edit-phone'];
        $address = $_POST['edit-address'];

        // Update client data
        $result = $db->updateClientData($companyName, $contactPerson, $phone, $address, $companyID);

        // Check the result of the update
        if ($result === "Data Updated") {
            $_SESSION['success_message'] = "Data Updated successfully";
        } else {
            $_SESSION['error_message'] = "Failed to update data: " . $result;
        }
    } else {
        $_SESSION['error_message'] = "You do not have permission to edit this client.";
    }

    header('Location: dashboard.php');
    exit();
} else {
    // If the form is not submitted, fetch client data from the database based on the client ID
    if (isset($_GET['company_id'])) {
        $companyID = $_GET['company_id'];

        // Fetch client data based on the client ID
        $clientData = $db->getClientData($companyID);

        // Check if the user attempting to edit is the one who created the entry
        if ($_SESSION['user']['user_id'] == $clientData['created_by']) {
            // Populate form fields with the retrieved data
            $companyID = $clientData['company_id'];
            $companyName = $clientData['company_name'];
            $contactPerson = $clientData['contact_person'];
            $phone = $clientData['phone'];
            $address = $clientData['address'];
        } else {
            $_SESSION['error_message'] = "You do not have permission to edit this client.";
            header('Location: dashboard.php');
            exit();
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
    <script src="dashboard.js"></script>
    <title>Edit Client Information</title>
</head>

<body class="bg-cover" style="background-image: url('Assets/forest.jpg');">
    <?php
    include 'toast.php';
    include 'header.php';
    ?>
    <form action="editClient.php" method="post">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-md mt-20" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="space-y-2 text-center p-4">
                <h1 class="text-3xl font-bold">Edit Client Information</h1>
                <p class="text-black">
                    Update your company details
                </p>
            </div>
            <div class="space-y-4 p-6">

                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="edit-company-id">Company ID</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="edit-company-id" name="edit-company-id" value="<?php echo $companyID; ?>" required="" readonly>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="edit-company-name">Company Name</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="edit-company-name" name="edit-company-name" value="<?php echo $companyName; ?>" required="">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="edit-contact-person">Contact Person</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="edit-contact-person" name="edit-contact-person" value="<?php echo $contactPerson; ?>" required="">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="edit-phone">Phone</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="edit-phone" name="edit-phone" value="<?php echo $phone; ?>" required="">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none" for="edit-address">Address</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-4 py-2 text-sm ring-offset-background" id="edit-address" name="edit-address" value="<?php echo $address; ?>" required="">
                </div>
                <button class="text-white bg-[#1A202C] inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit">
                    Update Client
                </button>
            </div>
        </div>
    </form>
</body>

</html>