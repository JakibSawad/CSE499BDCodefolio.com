<?php

//Your Mysql Config
$servername = "localhost";
$username = "bdcodefo_bdcodefo";
$password = "Q^(5Ei~@ZU?L";
$dbname = "bdcodefo_jobportal";

//Create New Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if($conn->connect_error) {
die("Connection Failed: ". $conn->connect_error);
}
