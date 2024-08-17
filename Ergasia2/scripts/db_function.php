<?php
require("credentials.php");

$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("connection Error");
}

function display_data()
{
    global $con;
    $query = "SELECT *
              FROM users
              WHERE `status`='pending'
              ORDER BY id Desc";
    $result = mysqli_query($con, $query);
    return $result;
}
