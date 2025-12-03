<?php
session_start();

require_once('CRUD/DatabaseConnection.php');

$db = new DatabaseConnection();

// Ensure that both email and password are provided
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    // Handle the case where either email or password is missing
    $_SESSION['error_message'] = "Both email and password are required.";
    header('Location: login.php');
    exit();
}

// Trim input values to remove leading and trailing whitespace
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Check login credentials using email
$loginResult = $db->checkLoginWithEmail($email, $password);

if ($loginResult === "User not found" || $loginResult === "Incorrect password") {
    // Login failed, display an error message
    $_SESSION['error_message'] = "Login failed: " . $loginResult;
} else {
    // Verify the entered password against the hashed password
    $hashedPasswordInDB = $loginResult['password'];

    if (password_verify($password, $hashedPasswordInDB)) {
        // Password is correct, store user data in session
        $_SESSION['user'] = $loginResult;

        // Set success message for the toast
        $_SESSION['success_message'] = "Login successful.";
        // Redirect to the dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        // Password is incorrect, display an error message
        $_SESSION['error_message'] = "Login failed: Incorrect password";
    }
}
header('Location: login.php');
exit();
