<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect to the login page
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Include the DatabaseConnection class
require_once 'CRUD/DatabaseConnection.php';

// Create an instance of the DatabaseConnection class
$db = new DatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button is clicked
    if (!empty($_POST['delete-company-id'])) {
        // Retrieve form data
        $companyID = $_POST['delete-company-id'];

        // Fetch client data based on the client ID
        $clientData = $db->getClientData($companyID);

        // Check if the user attempting to delete is the one who created the entry
        if (!empty($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] == $clientData['created_by']) {
            // Delete client data
            $result = $db->deleteData('clients', 'company_id', $companyID, 'created_by', $_SESSION['user']['user_id']);

            // Check the result of the delete operation
            if ($result) {
                $_SESSION['success_message'] = "Client Deleted successfully";
            } else {
                $_SESSION['error_message'] = "Failed to delete client";
            }
        } else {
            $_SESSION["error_message"] = "You don't have permissions for this operation";
        }

        // Redirect to the dashboard or another appropriate page
        header('Location: dashboard.php');
        exit();
    }
}
