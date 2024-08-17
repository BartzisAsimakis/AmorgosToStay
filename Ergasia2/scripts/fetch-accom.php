<?php
session_start();
$uname = $_SESSION['username'];

require("./credentials.php");

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    mysqli_select_db($con, $db_name);
    $query = "SELECT email, tel, bname FROM users WHERE username = '$uname'";
    $user = mysqli_query($con, $query);

    $query = "SELECT * FROM accommodations WHERE username = '$uname'";
    $accom = mysqli_query($con, $query);

    // send user[tel] and user[email] and bname to create-page.php
    $user = mysqli_fetch_assoc($user);
    // send accom[accomName], accom[mobile], accom[address], accom[area] to create-page.php
    $accom = mysqli_fetch_assoc($accom);

    echo json_encode(array($user, $accom));
}

mysqli_close($con);
