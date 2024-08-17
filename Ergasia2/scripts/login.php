<?php
header('Content-Type: application/json');

$uname = $_POST['uname'];
$pass = $_POST['pwd'];
if (isset($_POST['remember'])) {
    $rem = $_POST['remember'];
}
require("./credentials.php");

// Set session cookie lifetime
if ($rem == "on") {
    session_set_cookie_params(604800);
} else {
    session_set_cookie_params(86400);
}

session_start();

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    mysqli_select_db($con, $db_name);
    echo "Uname = '$uname'";
    echo "Pass = '$pass'";
    echo "Rem = '$rem'";

    // Check if user exists in users or admins table in the database
    $query = "SELECT username, passwd
            FROM admins
            WHERE username='$uname'
            AND passwd='$pass'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_row($result);

    if ($rows) {
        // Admin authenticated
        unset($_SESSION['accepted']); // Unset session variable
        $_SESSION['username'] = $uname; // Set session variable
        $_SESSION['admin'] = true; // Set session variable
        $message = "You have logged in as '$uname'.";
        header('Location: ../index.php');
        die;
    }

    // Check if user exists in users table in the database
    $query = "SELECT username, passwd
            FROM users
            WHERE username='$uname'
            AND passwd='$pass'
            AND `status`='accepted'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_row($result);

    if ($rows) {
        // User authenticated
        $_SESSION['username'] = $uname; // Set session variable
        $_SESSION['accepted'] = true; // Set session variable
        unset($_SESSION['admin']); // Unset session variable

        $message = "You have logged in as '$uname'.";
        header('Location: ../index.php');
    } else {
        // Wrong credentials
        header('Location: ../login.html');
    }
}
mysqli_close($con);
