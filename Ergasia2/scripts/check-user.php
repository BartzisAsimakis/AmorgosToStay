<?php
header('Content-Type: application/json');

$uname = $_POST['uname'];
require("./credentials.php");

$con = mysqli_connect($host, $username, $password);
if (!$con) {
    echo "problem in the connection" . mysqli_connect_error();
    exit();
} else {
    mysqli_select_db($con, $db_name);
    $query = "SELECT username FROM users WHERE username='$uname'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_row($result);

    if ($rows != 0) {
        echo json_encode(['exists' => true, 'message' => "Username '$uname' is already taken."]);
    } else {
        echo json_encode(['exists' => false, 'message' => "Username '$uname' is available."]);
    }
}
mysqli_close($con);
