<?php
$servername = "localhost";
$user_name = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $user_name, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_url = 'http://localhost/task/admin/';
///$editor_url = 'http://localhost/task/editor/';
?>
