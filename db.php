<?php
// Database Configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bdcodefo_bdcodefo');
define('DB_PASSWORD', 'Q^(5Ei~@ZU?L');
define('DB_NAME', 'bdcodefo_jobportal');

// Create Database Connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check Connection
if ($conn->connect_errno) {
    // Log error details (recommend using error logging in production)
    error_log("Database Connection Failed: " . $conn->connect_error);
    
    // Display user-friendly error message
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}

// Optional: Set character set to ensure proper character handling
$conn->set_charset("utf8mb4");
