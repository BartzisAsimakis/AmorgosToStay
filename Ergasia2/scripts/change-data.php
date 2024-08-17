<?php
session_start();
header('Content-Type: application/json');
require("./credentials.php");

$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$bname = $_POST['businessName'];
$tel = $_POST['telephone'];
$email = $_POST['email'];
$pwd = $_POST['password'];

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    $usr = $_SESSION['username'];
    mysqli_select_db($con, $db_name);
    $query = "UPDATE users 
            SET fname='$fname', lname='$lname', bname='$bname', tel='$tel', email='$email', passwd='$pwd'
            WHERE username='$usr'";
    $result = mysqli_query($con, $query);

    header('Location: ../user.php');
}
