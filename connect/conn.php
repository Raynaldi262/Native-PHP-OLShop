<?php
$conn = mysqli_connect("localhost", "root", "", "monkers_apparel") or die("Error in connection!");
// mysqli_select_db($conn, $database) or die("Could not select database");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
