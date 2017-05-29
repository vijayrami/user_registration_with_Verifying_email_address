<?php
$DB_HOST = "localhost";				
$DB_USERNAME = "root";				
$DB_PASSWORD = "";				
$DB_NAME = "phppractice";					
$db_conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>