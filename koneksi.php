<?php
$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is blank
$database = "webdailyjournal";

try {
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Connection error: " . $e->getMessage());
}
?>