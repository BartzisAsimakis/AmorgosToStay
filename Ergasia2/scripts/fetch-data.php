<?php
session_start();
require("./credentials.php");

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    $usr = $_SESSION['username'];
    mysqli_select_db($con, $db_name);
    $query = "SELECT *
            FROM users 
            WHERE username='$usr'";
    $result = mysqli_query($con, $query);
    //$rows = mysqli_fetch_row($result);

    // Simulate fetching user data from the database
    $userData = array();

    // Fetch each row from the result set and add it to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $userData[] = $row;
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($userData);
}
