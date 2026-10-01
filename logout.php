<?php
// Start the session
session_start();

// Always destroy the session
session_destroy();

// Redirect to the login page or another page
header('Location: index.php');
exit;
